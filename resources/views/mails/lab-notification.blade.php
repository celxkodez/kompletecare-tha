<x-mail::message>
    # Error Notification!
    Hello,

    A medical record has been created with the details Below

    Investigation Types

    @foreach($medicalRecord->investigationTypes as $investigationType)
        Name: {{$investigationType->name}}
        subgroup: {{$investigationType->subgroup}}
    @endforeach

    <x-mail::button :url="$appUrl">
        Log on to the View
    </x-mail::button>

    Kind Regards,
    {{ 'Celestine' }}
</x-mail::message>
