<li class="nav-item topbar-icon dropdown hidden-caret">
    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span class="notification">{{ $notifications->count() }}</span>
    </a>
    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
        <li>
            <div class="dropdown-title">
                You have {{ $notifications->count() }} new notifications
            </div>
        </li>
        <li>
            <div class="notif-scroll scrollbar-outer">
                <div class="notif-center">
                    @foreach ($notifications as $notification)
                        <a href="javascript:;" class="mark-as-read"
                            data-meeting-id="{{ $notification->data['meeting_id'] }}">
                            <div class="notif-icon notif-primary">
                                @if ($notification->type === 'App\Notifications\ZoomRegistered')
                                    <i class="fas fa-video"></i>
                                @else
                                    <i class="fa fa-info"></i>
                                @endif
                            </div>
                            <div class="notif-content">
                                <span class="block">{{ $notification->data['message'] }}</span>
                                <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        <li>
            <a class="see-all" href="{{ route('notifications.all') }}">See all notifications<i
                    class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</li>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationCountElement = document.querySelector('.notification');
        document.querySelectorAll('.mark-as-read').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();

                var meetingId = this.getAttribute('data-meeting-id');
                console.log(meetingId);

                fetch("{{ route('notifications.markAsRead', '') }}/" + meetingId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                }).then(response => response.json()).then(data => {
                    if (data.status === 'success') {
                        alert('Notice read');

                        let currentCount = parseInt(notificationCountElement
                            .textContent);
                        console.log(currentCount);

                        notificationCountElement.textContent = currentCount > 0 ?
                            currentCount - 1 : 0;
                        window.location.href = "/account/zooms/" + meetingId;

                    } else {
                        console.error(data.message);
                    }
                }).catch(error => {
                    console.log("Error occurred", error);
                    alert('An error occurred');
                });
            });
        });
    });
</script>
