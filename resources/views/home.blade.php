@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

@php
      $roles = Auth::user()->roles;
        $name = null;
        foreach ($roles as $key => $role) {
            $name = $role['name'];
        }
        switch ($name) {
          case 'Admin':
            echo 'Admin';
            break;
          case 'student':
            // return '/check';
            echo 'student';
            break;

          default:
            echo '/home';
          break;
        }
@endphp
@endsection
