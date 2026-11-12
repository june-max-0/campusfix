# Routes

| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET,HEAD | sanctum/csrf-cookie | sanctum.csrf-cookie | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show |
| GET,HEAD | _ignition/health-check | ignition.healthCheck | Spatie\LaravelIgnition\Http\Controllers\HealthCheckController |
| POST | _ignition/execute-solution | ignition.executeSolution | Spatie\LaravelIgnition\Http\Controllers\ExecuteSolutionController |
| POST | _ignition/update-config | ignition.updateConfig | Spatie\LaravelIgnition\Http\Controllers\UpdateConfigController |
| GET,HEAD | api/user | - | Closure |
| GET,HEAD | / | home | App\Http\Controllers\PageController@home |
| GET,HEAD | dashboard | dashboard | App\Http\Controllers\PageController@dashboard |
| GET,HEAD | profile | profile.edit | App\Http\Controllers\ProfileController@edit |
| PATCH | profile | profile.update | App\Http\Controllers\ProfileController@update |
| DELETE | profile | profile.destroy | App\Http\Controllers\ProfileController@destroy |
| GET,HEAD | requests | requests.index | App\Http\Controllers\ServiceRequestController@index |
| GET,HEAD | requests/create | requests.create | App\Http\Controllers\ServiceRequestController@create |
| POST | requests | requests.store | App\Http\Controllers\ServiceRequestController@store |
| GET,HEAD | requests/{serviceRequest}/edit | requests.edit | App\Http\Controllers\ServiceRequestController@edit |
| PUT,PATCH | requests/{serviceRequest} | requests.update | App\Http\Controllers\ServiceRequestController@update |
| DELETE | requests/{serviceRequest} | requests.destroy | App\Http\Controllers\ServiceRequestController@destroy |
| GET,HEAD | feedback | feedback.index | App\Http\Controllers\FeedbackController@index |
| GET,HEAD | feedback/create | feedback.create | App\Http\Controllers\FeedbackController@create |
| POST | feedback | feedback.store | App\Http\Controllers\FeedbackController@store |
| GET,HEAD | register | register | App\Http\Controllers\Auth\RegisteredUserController@create |
| POST | register | - | App\Http\Controllers\Auth\RegisteredUserController@store |
| GET,HEAD | login | login | App\Http\Controllers\Auth\AuthenticatedSessionController@create |
| POST | login | - | App\Http\Controllers\Auth\AuthenticatedSessionController@store |
| GET,HEAD | forgot-password | password.request | App\Http\Controllers\Auth\PasswordResetLinkController@create |
| POST | forgot-password | password.email | App\Http\Controllers\Auth\PasswordResetLinkController@store |
| GET,HEAD | reset-password/{token} | password.reset | App\Http\Controllers\Auth\NewPasswordController@create |
| POST | reset-password | password.store | App\Http\Controllers\Auth\NewPasswordController@store |
| GET,HEAD | verify-email | verification.notice | App\Http\Controllers\Auth\EmailVerificationPromptController |
| GET,HEAD | verify-email/{id}/{hash} | verification.verify | App\Http\Controllers\Auth\VerifyEmailController |
| POST | email/verification-notification | verification.send | App\Http\Controllers\Auth\EmailVerificationNotificationController@store |
| GET,HEAD | confirm-password | password.confirm | App\Http\Controllers\Auth\ConfirmablePasswordController@show |
| POST | confirm-password | - | App\Http\Controllers\Auth\ConfirmablePasswordController@store |
| PUT | password | password.update | App\Http\Controllers\Auth\PasswordController@update |
| POST | logout | logout | App\Http\Controllers\Auth\AuthenticatedSessionController@destroy |
