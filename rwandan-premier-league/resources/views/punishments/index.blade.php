@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Punishments</h2>

    <!-- Button to open Create Punishment form -->
    <a href="{{ route('punishments.create') }}" class="btn btn-primary mb-3">Create Punishment</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th> <!-- Display team name or user name -->
                <th>Type</th>
                <th>Reason</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
        @foreach ($punishments as $punishment)
           <tr>
               <!-- Display the correct name based on who is punished -->
               <td>
    @if($punishment->team)
        {{ $punishment->team->name }}
    @elseif($punishment->player)
        {{ $punishment->player->name }}
    @elseif($punishment->coach)
        {{ $punishment->coach->name }}
    @elseif($punishment->referee)
        {{ $punishment->referee->name }}
    @else
        No Name Available
    @endif
</td>


               <td>{{ $punishment->type }}</td>
               <td>{{ $punishment->reason }}</td>
               <td>{{ $punishment->start_date }}</td>
               <td>{{ $punishment->end_date }}</td>
               <td>
                   <!-- Edit Button -->
                   <a href="{{ route('punishments.edit', $punishment->id) }}" class="btn btn-warning btn-sm">Edit</a>

                   
                   <!-- Terminate Button (only if punishment is ongoing) -->
                   @if(!$punishment->end_date)
                       <form action="{{ route('punishments.terminate', $punishment->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('PUT')
                       </form>
                   @else
                   @endif

                   <!-- Delete Button with Confirmation -->
                   <form action="{{ route('punishments.destroy', $punishment->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                   </form>
               </td>
           </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this punishment? This action cannot be undone.');
}
</script>
