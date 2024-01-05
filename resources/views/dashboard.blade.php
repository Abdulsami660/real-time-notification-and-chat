<x-app-layout>

    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        All Users
                    </div>
                    <div class="card-body">
                        <ul class="list-group all-users">
                            @forelse($users as $user)
                                <li data-id="{{$user->id}}" class="list-group-item single-user"><img width="50"
                                        src="{{ asset('dummy-user.png') }}" alt="User Image"> {{ $user->name }} <b><sup
                                            id="user-{{ $user->id }}-status"
                                            class="offline-status">(Offline)</sup></b></li>
                            @empty
                                <li class="list-group-item">No User Found !</li>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9" id="chat-with-user-area">
                <div class="card">
                    <div class="card-header">
                        Begin Chat
                    </div>
                    <div class="card-body">
                        <div id="chat-area">
                            <div id="chat-messages">
                                
                            </div>

                        </div>

                    </div>
                </div>
                <form id="send-message-form">
                <div class="send-message-area mt-4">
                    <div class="row align-items-center">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <textarea id="chat-input" required class="form-control" placeholder="Enter Your Message"></textarea>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

</x-app-layout>
