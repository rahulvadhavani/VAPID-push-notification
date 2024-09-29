@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <button class="btn btn-primary" id="subscribe">Subscribe for Push Notifications</button>
                    <button  class="btn btn-primary" id="trigger-notification">Trigger Notification</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    document.getElementById('subscribe').addEventListener('click', function() {
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                navigator.serviceWorker.ready.then(function(registration) {
                    registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: '{{ env("VAPID_PUBLIC_KEY") }}'
                    }).then(function(subscription) {
                        console.log('User is subscribed:', subscription);

                        fetch('/save-subscription', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(subscription)
                        });
                    });
                });
            }
        });
    });
    document.getElementById('trigger-notification').addEventListener('click', function() {
        fetch("{{route('send')}}", {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send notification.');
            });
    });
</script>
@endpush
@endsection