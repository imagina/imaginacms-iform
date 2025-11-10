<?php

namespace Modules\Iform\Models;

use Imagina\Icore\Models\CoreModel;
use Modules\Iuser\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Isetting\Models\Setting;


class Lead extends CoreModel
{

  protected $table = 'iform__leads';
  public string $transformer = 'Modules\Iform\Transformers\LeadTransformer';
  public string $repository = 'Modules\Iform\Repositories\LeadRepository';
  public array $requestValidation = [
    'create' => 'Modules\Iform\Http\Requests\CreateLeadRequest',
    'update' => 'Modules\Iform\Http\Requests\UpdateLeadRequest',
  ];
  //Instance external/internal events to dispatch with extraData
  public array $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [
      [
        'path' => 'Modules\Inotification\Events\SendNotification',
        'extraData' => ['event' => 'created']
      ],
      ['path' => 'Modules\Imedia\Events\CreateMedia']
    ],
    'creating' => [],
    'updated' => [
      ['path' => 'Modules\Imedia\Events\UpdateMedia']
    ],
    'updating' => [],
    'deleting' => [
      ['path' => 'Modules\Imedia\Events\DeleteMedia']
    ],
    'deleted' => []
  ];
  protected $fillable = [
    'form_id',
    'assigned_to_id',
    'values'
  ];

  protected $casts = [
    'values' => 'array'
  ];

  /**
   * Media Fillable
   */
  public $mediaFillable = [
    'file' => 'single'
  ];

  public function form(): BelongsTo
  {
    return $this->belongsTo(Form::class);
  }

  public function assignedTo(): BelongsTo
  {
    return $this->belongsTo(User::class, 'assigned_to_id');
  }

  /**
   * Notification Params
   */
  public function getNotificableParams(): array
  {

    $emails = [];
    $form = $this->form;
    $lead = $this;
    $numberLead = $lead->id;

    //Get Emails
    $emails = $this->form->destination_email ?? [];

    //Check form system_name || TODO pass to config
    if ($form->system_name == config('iform.formSystemNameToProcessPDF')) {

      //Get all to update later
      $settingIncrementalCode = Setting::where('system_name', 'iform::incrementalCode')->first();
      $codeIncrement = $settingIncrementalCode->plain_value;

      //Update number lead to title
      $numberLead = $numberLead . ' | #' . $codeIncrement;

      //Incrementar y guardar el setting de nuevo.
      $settingIncrementalCode->plain_value = $codeIncrement + 1;
      $settingIncrementalCode->save();

      //Get form code
      $codeForm = setting("iform::formCode");

      //Create PDF
      $pdf = Pdf::loadView('iform::pdfs.lead-pqrsf', compact('lead', 'codeForm', 'codeIncrement'))
        ->setOptions(['isRemoteEnabled' => true]);

      //Data to Attachment
      $dataAttachment = [
        'fileName' => $form->system_name . '_' . $lead->id . '.pdf',
        'fileData' => base64_encode($pdf->output()), //Important to encode and decode later in Inotification module
        'fileMimeType' => 'application/pdf',
      ];
    }

    return [
      'created' => [
        "email" => $emails,
        "title" => $form->title . " | " . itrans("iform::lead.email.created.title") . " | #" . $numberLead,
        "content" => "iform::emails.lead",
        "extraParams" => [
          "lead" => $lead,
          "form" => $form
        ],
        "attachment" => $dataAttachment ?? null,
      ],
    ];
  }

  public function files()
  {
    if (isModuleEnabled('Imedia')) {
      return app(\Modules\Imedia\Relations\FilesRelation::class)->resolve($this);
    }
    return new \Imagina\Icore\Relations\EmptyRelation();
  }
}
