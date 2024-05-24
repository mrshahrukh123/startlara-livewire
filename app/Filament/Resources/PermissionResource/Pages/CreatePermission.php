<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;


class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Permission Created')
            ->body('The permission has been created successfully.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = Str::slug($data['name'],'-');

        return $data;
    }
}
