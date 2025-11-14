@php
    $form = $data['extraParams']['form'];
    $lead = $data['extraParams']['lead'];
    $fields = $form->fields;
@endphp
<h1 style="font-size: 22px;text-center">{!! $data["title"] !!}</h1>

<table style="width: 100%;border-collapse: collapse; text-align:left">
    <tbody>
        @foreach($fields as $field)
          @php
          $value = $lead->values[$field->system_name] ?? "";
          $isBoolean = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
          @endphp
            <tr>
                <th style="background-color: #eee;">{{ $field->label }}</th>
              <td>
                @if($isBoolean)
                  {{ trans('iform::lead.form.boolValue.'. $value?'yes' : 'no') }}
                @else
                  {{$field->type == 12 ? url($value): $value}}
                @endif
              </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>