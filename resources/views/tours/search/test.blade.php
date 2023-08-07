<!DOCTYPE html>
<html>
<head>
    <title>Tours</title>
</head>
<body>
    <form method="POST" action="{{ route('tours.filter') }}">
        @csrf
        <label for="budget">Select your budget:</label>
        <input type="range" id="budget" name="budget" min="0" max="1000" step="10">
        <span id="selected-budget">0</span>
        <button type="submit">Filter Tours</button>
    </form>

    <div>
        <h2>Filtered Tours</h2>
        @foreach($tours as $tour)
            <p>{{ $tour->name }} - {{ $tour->price }}</p>
        @endforeach
    </div>

    <script>
        const budgetInput = document.getElementById('budget');
        const selectedBudget = document.getElementById('selected-budget');

        budgetInput.addEventListener('input', function() {
            selectedBudget.innerText = budgetInput.value;
        });
    </script>
</body>
</html>
