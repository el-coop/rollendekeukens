<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DestroyUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Orchid\Fields\ModalButton;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Support\Facades\Alert;
use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserListLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;

class UserListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'panel.users';
    
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'panel.usersDescription';
    
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        return [
            'users' => User::with('roles')
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }
    
    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [
            Link::make(__('panel.settingsTab'))
                ->href(action('\App\Orchid\Screens\PlatformScreen@handle'))
                ->turbolinks(false)
                ->icon('icon-picture'),
            
            Link::make(__('panel.albums'))
                ->href(action('\App\Orchid\Screens\Album\AlbumListScreen@handle'))
                ->turbolinks(false)
                ->icon('icon-picture'),
            Link::make(__('panel.site'))
                ->href(env('APP_URL'))
                ->turbolinks(false)
                ->target('_blank')
                ->icon('icon-globe-alt'),
        ];
    }
    
    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array {
        return [
            UserListLayout::class,
            Layout::rows([
                ModalButton::make(__('user.add'))
                    ->modal('userModal')
                    ->method('createUser')
                    ->class('btn btn-primary mb-5')
                    ->right(),
            ]),
            Layout::modal('userModal', [
                UserEditLayout::class
            ])->title(__('panel.user'))->async('asyncGetUser')
                ->size(Modal::SIZE_LG),
        ];
    }
    
    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetUser(Request $request): array {
        $user = User::find($request->input(0, 0));
        if (!$user) {
            $user = new User;
        }
        
        return [
            'user' => $user,
        ];
    }
    
    /**
     * @param User $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(CreateUserRequest $request) {
        $request->commit();
        Alert::info(__('user.created'));
        return back();
    }
    
    public function deleteUser($user, DestroyUserRequest $request) {
        $request->commit();
        
        Alert::info(__('panel.userDeleted'));
        return back();
    }
    
    public function updateUser(UpdateUserRequest $request) {
        $request->commit();
        Alert::info(__('user.saved'));
        return back();
    }
}
