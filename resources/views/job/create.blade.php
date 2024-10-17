<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs">

        <x-forms.input label="Title" name="title" placeholder="Job Position" />
        <x-forms.input label="Salary" name="salary" placeholder="$63,000" />
        <x-forms.input label="Location" name="location" placeholder="Tirana, Albania" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Full-Time</option>
            <option>Part-Time</option>
            <option>Remote</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="http://url.com/jobs/job-position" />

        <x-forms.divider />

        <x-forms.checkbox label="Feature ($25 per Month)" name="featured" />

        <x-forms.divider />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>
