@php
    $form = $data['extraParams']['form'];
    $lead = $data['extraParams']['lead'];
    $fields = $form->fields;
@endphp
<h1 style="font-size: 22px;text-center">{!! $data["title"] !!}</h1>

<table style="width: 100%;border-collapse: collapse; text-align:left">
    <tbody>
        @foreach($fields as $field)
            <tr>
                <th style="background-color: #eee;">{{ $field->label }}</th>
                @if($field->type == 12)
                    <td>{{ url($lead->values[$field->system_name] ?? "") }}</td>
                @else
                    <td>{{ $lead->values[$field->system_name] ?? "" }}</td>
                @endif
            </tr>
        @endforeach

    </tbody>
</table>
<br>