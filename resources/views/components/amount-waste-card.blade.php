<div class="card card-layout">
  <div class="card-header border-0">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Amounts of waste</h3>

      <div class="form-group">
        <select class="custom-select" id="timeframe-select" onchange="updateChart()">
          <option value="days">Days</option>
          <option value="month">Month</option>
        </select>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="position-relative mb-4">
      <canvas id="amount-waste-chart" height="200"></canvas>
    </div>

    <div class="d-flex flex-row justify-content-between legend-info-1">
      <div class="d-flex align-items-center">
        <div class="mr-2 rounded" style="width: 15px; height: 15px; background-color: #FA897F;"></div>
        <div>Anorganic</div>
      </div>

      <div class="d-flex align-items-center">
        <div class="mr-2 rounded" style="width: 15px; height: 15px; background-color: #5AB2FF;"></div>
        <div>Residu</div>
      </div>

      <div class="d-flex align-items-center">
        <div class="mr-2 rounded" style="width: 15px; height: 15px; background-color: #58BA77;"></div>
        <div>Organic</div>
      </div>
    </div>
  </div>
</div>