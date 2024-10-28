<div class="card card-layout">
  <div class="card-header border-0">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Type of waste</h3>
    </div>
  </div>
  <div class="card-body">
    <div class="position-relative">
      <div class="position-absolute" style="height: 100%; color: white; z-index: 9999; top: 100%; left: 50%; transform: translate(-50%, -50%);">
          <div class="d-flex align-items-center">
            <div>Organic</div>
            <div>15%</div>
          </div>
        </div>
      <canvas id="type-waste-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
        
      </canvas>
    </div>

    <div class="d-flex flex-row justify-content-between legend-info-2">
      <div class="d-flex align-items-center">
        <button type="button" class="btn btn-block btn-primary border-0 btn-type-waste"
          style=" background-color: #54BC73;">Organic
        </button>
      </div>

      <div class="d-flex align-items-center">
        <button type="button" class="btn btn-block btn-primary border-0 btn-type-waste"
          style="background-color: #466FD2;">Residu
        </button>
      </div>

      <div class="d-flex align-items-center">
        <button type="button" class="btn btn-block btn-primary border-0 btn-type-waste"
          style="background-color: #5AB2FF;">Anorganic
        </button>
      </div>
    </div>
  </div>
</div>