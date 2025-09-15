<!-- ApexCharts Example -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Example: Simple line chart
    var options = {
      chart: {
        type: 'line',
        height: 350,
        toolbar: { show: false }
      },
      series: [{
        name: 'Sales',
        data: [10, 41, 35, 51, 49, 62, 69]
      }],
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart-line"), options);
    chart.render();
  });
</script>

<!-- World Map Example with jsVectorMap -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const map = new jsVectorMap({
      selector: "#world-map",
      map: "world",
      zoomButtons: true,
      zoomOnScroll: false,
      markers: [
        { name: "New York", coords: [40.7128, -74.006] },
        { name: "London", coords: [51.5074, -0.1278] },
        { name: "Tokyo", coords: [35.6895, 139.6917] }
      ]
    });
  });
</script>

<!-- Modal Delete Confirmation -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-confirm");
    deleteButtons.forEach(btn => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        const url = this.getAttribute("href");
        if (confirm("Are you sure you want to delete this item?")) {
          window.location.href = url;
        }
      });
    });
  });
</script>

<!-- Database Clear Modal Submit -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dbClearForm = document.querySelector(".db-clear-submit");
    if (dbClearForm) {
      dbClearForm.addEventListener("submit", function (e) {
        e.preventDefault();
        if (confirm("This will wipe your database. Are you sure?")) {
          dbClearForm.submit();
        }
      });
    }
  });
</script>

<!-- Optional: other charts -->
@stack('custom-scripts')
