<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrations</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">AlienVault</h5>
                <p class="card-text">Integrate with AlienVault</p>
                <button id="setupButton" class="btn btn-primary">Setup</button>
            </div>
        </div>
    </div>

    <div id="setupModal" style="display:none;">
        <form id="setupForm" method="POST" action="{{ route('integrations.save') }}">
            @csrf
            <label for="url">URL:</label>
            <input type="text" id="url" name="url">
            <label for="token">Token:</label>
            <input type="text" id="token" name="token">
            <button type="submit">Save</button>
            <button type="button" onclick="closeModal()">Cancel</button>
        </form>
    </div>

    <script>
        document.getElementById('setupButton').addEventListener('click', function() {
            document.getElementById('setupModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('setupModal').style.display = 'none';
        }
    </script>
</body>
</html>
