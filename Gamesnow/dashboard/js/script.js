const ctx = document.getElementById('chartAlcance');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'ALCANCE PÚBLICO',
        data: [12000, 19000, 30000, 50000, 20000, 30000, 12000, 19000, 30000, 50000, 20000, 100],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctx2 = document.getElementById('chartCategorias');

  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: ['PC', 'Móviles', 'Trucos', 'Hardware','Tecnología','Esports'],
      datasets: [{
        label: 'CATEGORÍAS ',
        data: [90, 60, 75, 82, 100,45],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });



