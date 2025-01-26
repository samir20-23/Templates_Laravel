<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class ManageUsers extends Controller
{
    public function __construct(
        protected UserService $userService
      ) {
      }
  
      public function index()
      {
          $users = $this->userService->all();
          return view('admin.users.index', compact('users'));
      }
  
      public function create()
      {
          return view('admin.users.create');
      }
  
      public function store(Request $request)
      {
          $data = $request->validate([
              'name' => 'required',
              'email' => 'required|unique:users,email',
              'password' => 'required|confirmed'
          ]);
  
          $user = $this->userService->create($data);
  
          return redirect()->route('admin.users.index');
      }
  
      public function show($id)
      {
          $user = $this->userService->find($id);
          return view('admin.users.show', compact('user'));
      }
  
      public function edit($id)
      {
          $user = $this->userService->find($id);
          return view('admin.users.edit', compact('user'));
      }
  
      public function update(Request $request, $id)
      {
          $data = $request->validate([
              'name' => 'required',
              'email' => 'required|unique:users,email,'.$id,
              'password' => 'sometimes|confirmed'
          ]);
  
          $user = $this->userService->update($data, $id);
  
          return redirect()->route('admin.users.index', $user->id);
      }
  
      public function destroy($id)
      {
          $this->userService->delete($id);
  
          return redirect()->route('admin.users.index');
      }
}
