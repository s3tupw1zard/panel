<?php

namespace App\Extensions\OAuth\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use SocialiteProviders\Keycloak\Provider;

final class KeycloakSchema extends OAuthSchema
{
    public function getId(): string
    {
        return 'keycloak';
    }

    public function getSocialiteProvider(): string
    {
        return Provider::class;
    }

    public function getServiceConfig(): array
    {
        return [
            'base_url'      => env('OAUTH_KEYCLOAK_BASE_URL'),
            'realm'         => env('OAUTH_KEYCLOAK_REALM'),
            'client_id'     => env('OAUTH_KEYCLOAK_CLIENT_ID'),
            'client_secret' => env('OAUTH_KEYCLOAK_CLIENT_SECRET'),
        ];
    }

    public function getSettingsForm(): array
    {
        return array_merge(parent::getSettingsForm(), [
            TextInput::make('OAUTH_KEYCLOAK_BASE_URL')
                ->label('Base URL')
                ->placeholder('https://auth.example.com')
                ->columnSpan(2)
                ->required()
                ->url()
                ->autocomplete(false)
                ->default(env('OAUTH_KEYCLOAK_BASE_URL')),
            TextInput::make('OAUTH_KEYCLOAK_REALM')
                ->label('Realm')
                ->placeholder('master')
                ->required()
                ->autocomplete(false)
                ->default(env('OAUTH_KEYCLOAK_REALM', 'master')),
            TextInput::make('OAUTH_KEYCLOAK_DISPLAY_NAME')
                ->label('Display Name')
                ->placeholder('Display Name')
                ->autocomplete(false)
                ->default(env('OAUTH_KEYCLOAK_DISPLAY_NAME', 'Keycloak')),
            ColorPicker::make('OAUTH_KEYCLOAK_DISPLAY_COLOR')
                ->label('Display Color')
                ->placeholder('#0083be')
                ->default(env('OAUTH_KEYCLOAK_DISPLAY_COLOR', '#0083be'))
                ->hex(),
        ]);
    }

    public function getName(): string
    {
        return env('OAUTH_KEYCLOAK_DISPLAY_NAME', 'Keycloak');
    }

    public function getIcon(): ?string
    {
        return env('OAUTH_KEYCLOAK_ICON', 'tabler-user-shield');
    }

    public function getHexColor(): string
    {
        return env('OAUTH_KEYCLOAK_DISPLAY_COLOR', '#0083be');
    }
}
