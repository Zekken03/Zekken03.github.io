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

  const ctx3 = document.getElementById('chartPaises');

  new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ['México', 'Estados Unidos', 'Paraguay', 'Bolivia','Afganistán','Perú','Buenaventura','Veracruz'],
      datasets: [{
        label: 'ALCANCE EN PAÍSES ',
        data: [190, 125, 75, 100, 10, 130, 50, 150],
        backgroundColor: [
          '#28a745', 
          '#007bff', 
          '#ffc107', 
          '#17a2b8', 
          '#fd7e14',
          ' #dc3545', 
          '#6c757d ', 
          'blue'  
        ],
        borderWidth: 2
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: {
          usePointStyle: true, 
          pointStyle: 'rectRounded', 
          boxWidth: 15, 
          boxHeight: 15,
          padding: 20, 
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  const ctx4 = document.getElementById('chartEdades');

  new Chart(ctx4, {
    type: 'polarArea',
    data: {
      labels: ['18 - 19', '20s', '30s', '40s','50s','60s','70s','80s','90s','100s'],
      datasets: [{
        label: 'CATEGORÍAS ',
        data: [90, 60, 75, 82, 100,45, 15,10,5, 1],
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
