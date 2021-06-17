<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($roomName) }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-4 gap-4 p-4">
      <div class="col-span-3">
        <div id="publisher" style="height: 250px; width: 250px;"></div>
        <div id="subscriber" style="height: 250px; width: 250px;"></div>
      </div>
      <div id="events" class="bg-white rounded"></div>
    </div>
    

    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script type="text/javascript">
    function handleError(error) {
  if (error) {
    alert(error.message);
  }
}

// (optional) add server code here
initializeSession();

function initializeSession() {
  var session = OT.initSession('{{ $apiKey }}', '{{ $sessionId }}');

  // Subscribe to a newly created stream
  session.on('streamCreated', function(event) {
    session.subscribe(event.stream, 'subscriber', {
      insertMode: 'append',
      width: '100%',
      height: '100%'
    }, handleError);
  });

  // Create a publisher
  var publisher = OT.initPublisher('publisher', {
    insertMode: 'append',
    width: '100%',
    height: '100%'
  }, handleError);

  // Connect to the session
  session.connect('{{ $token }}', function(error) {
    // If the connection is successful, initialize a publisher and publish to the session
    if (error) {
      handleError(error);
    } else {
      session.publish(publisher, handleError);
    }
  });

  session.on('signal', event  => {
    if (event.type === 'signal:user-join') {
      const payload = JSON.parse(event.data);
      const eventDiv = document.createElement('div');
      eventDiv.innerHTML = payload.username + " has joined";
      document.getElementById('events').append(eventDiv);
    }
  });
}
    </script>
</x-app-layout>