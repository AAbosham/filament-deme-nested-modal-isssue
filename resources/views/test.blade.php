<div>
    @if ($widget = App\Filament\Resources\Blog\PostResource\Widgets\Comments::class)
        @livewire(
            \Livewire\Livewire::getAlias($widget),
            [
                'record' => $record,
            ],
            key('blog-comments' . $record->id)
        )
    @endif
</div>
