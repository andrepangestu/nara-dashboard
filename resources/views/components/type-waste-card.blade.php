<div class="card card-layout">
  <div class="card-header border-0">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Type of waste</h3>
    </div>
  </div>

  <div class="card-body">
    <div class="position-relative">
      <div class="position-absolute text-white"
        style="height: 10%; z-index: 9999; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="d-flex flex-column align-items-center">
          <div class="text-center" style="font-weight: 300; line-height: 16.1px;">
            Total Waste (Kg)
          </div>
          <div class="d-flex flex-row align-items-center text-center">
            <div class="mr-2" style="font-size: 50px; font-weight: 900;">
              <span id="total-waste"></span>
            </div>
          </div>
        </div>
      </div>
      <canvas id="type-waste-chart" class="w-100" style="min-height: 250px; height: 250px; max-height: 250px;"></canvas>
    </div>

    <div class="d-flex flex-wrap justify-content-between legend-info-2 mt-3">
      <div class="align-items-center mb-2">
        <div class="btn btn-block btn-primary border-0 btn-type-waste" style="background-color: #54BC73;"
          data-toggle="tooltip" data-placement="bottom"
          title="Organic includes : Kotoran Hewan, Ranting, Kulit Telur, Daun, Minyak Jelantah, Sayuran">
          Organic
        </div>
      </div>

      <div class="align-items-center mb-2">
        <div class="btn btn-block btn-primary border-0 btn-type-waste" style="background-color: #5AB2FF;"
          data-toggle="tooltip" data-placement="bottom"
          title="Anorganic includes : Plastic PET, Plastic PP, Plastic LDPE, Plastic HDPE, Beling, Aluminium, Kaleng, Besi, Gabruk, Kertas, Kardus">
          Anorganic
        </div>
      </div>

      <div class="align-items-center mb-2">
        <div class="btn btn-block btn-primary border-0 btn-type-waste" style="background-color: #FA897F;"
          data-toggle="tooltip" data-placement="bottom" title="Residu includes :">
          Residu
        </div>
      </div>
    </div>
  </div>
</div>