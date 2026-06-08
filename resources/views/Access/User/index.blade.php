@extends('layouts.welcome-user')

@section('content-final')

  @if ($code == config('role.null.code'))

    {{-- CODE NULL --}}

    <!-- roles -->
    <div class="inline-block ma">

      @foreach ($data['roles'] as $role)

        <div class="mb-1">
          <a class="pv-1 ph-4 button button-route curvy-0 w-100 font-l font-text"
              href="{{ url($data['links'][$loop->index]) }}">
            {{-- translated, sorted --}}
            {{ $role['name'] }}
          
          </a>

        </div>

      @endforeach

    </div> <!-- /roles -->

  @else

    {{-- CODE ROLE CHOSEN --}}

    <!-- options -->
    <div class="single">
      <!-- create-user-wrapper -->
      <div class="mb-1 w-max-256 ma text-center">
        <!-- create-user -->
        <a class="w-100 font-text button button-route curvy-04"
            href="{{ route('user.create', ['code' => $code]) }}">
          + {{ __("Add Account") }}

        </a>

        </a> <!-- /create-user -->

      </div> <!-- /create-user-wrapper -->

      <!-- searchbox-wrapper -->
      <div class="w-max-256 ma">

        @include ('Snippet.searchbox', [
          'route' => route('user.index', ['code' => $code]),
          'search' => $search ?? ''
        ])

      </div> <!-- /searchbox-wrapper -->

    </div> <!-- /options -->

    <!-- users-positioner -->
    <div class="single text-center">
      <!-- users -->
      <div class="inline-block">

        @foreach ($data['users'] as $user)

          <!-- user -->
          <div class="input-file-parent mb-1">
            <!-- user-data -->
            <div class="input-file-metadata text-left">
              <a class="font-text button button-route curvy-round"
                  href="{{ url($data['links'][$loop->index]) }}">
                {{-- sorted --}}
                {{ $user['id'] }} {{ $user['fname'] }} {{ $user['lname'] }}
              
              </a>

            </div> <!-- /user-data -->

            <!-- trash-button -->
            <div>
              <form action="{{ route('user.destroy', ['user' => $user['id']]) }}"
                    method="post">

                @csrf

                @method('delete')

                <button class="input-file-button button button-icon reset-style"></button>
              
              </form>

            </div> <!-- /trash-button -->

          </div> <!-- /user -->

        @endforeach

      </div> <!-- /users -->

    </div> <!-- /users-positioner -->

  @endif

@endsection