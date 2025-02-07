@extends('layouts.admin')

@section('content')

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<div class="container">
  <h1 class="text-center mb-3">Visualizzazioni per anno del tuo appartamento</h1>
  <h4 class="text-center">Sponsorizza l'appartamento per ottenere più visualizzazioni</h4>

  <div class="m-auto p-3" style="width: 800px;">
    <canvas id="acquisitions"></canvas>
  </div>
</div>

<script type="text/javascript">
  let apartment_views_json = <?php echo json_encode($apartment_views); ?>;

  const result = [];

  apartment_views_json.forEach(obj => {
    // lo trasformo in un oggetto date e successivamente prendo solo gli anni
    const year = new Date(obj.date_view).getFullYear(); // 2022, 2021

    // se l'anno [year] esiste allora aggiungi +1 come count, altrimenti lo crea con valore 1.
    result[year] = (result[year] || 0) + 1;
  });

  // aggiungo year e count come chiavi
  const apartment_views = Object.entries(result).map(([year, count]) => ({
    year: parseInt(year),
    count
  }));

  new Chart(
    document.getElementById('acquisitions'), {
      type: 'line',
      data: {
        labels: apartment_views.map(row => row.year),
        datasets: [{
          label: 'Visualizzazioni per anno',
          data: apartment_views.map(row => row.count)
        }]
      }
    }
  );
</script>


@endsection