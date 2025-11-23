<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="table table-striped table-bordered align-middle">
          <thead class="table-primary">
            <tr>

            </tr>
          </thead>
          <tbody>
            @forelse ($foodDrinks as $index => $fnd)
              <tr>
                <td>{{ $fnd->name }}</td>
                <td>{{ $fnd->type }}</td>
                <td>{{ $fnd->price }}</td>
              </tr>
          </tbody>
    </table>
</body>
</html>