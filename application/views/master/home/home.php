<?php foreach($all as $gas) : ?>
<div class="container-fluid">
  <br>
  <h3 class="text-center"><i class='fas fa-map-marker-alt' style='font-size:36px;color:red'></i> LAMPUNG</h3>
  <br>
  <div class="row">
    <div class="col-sm-6 text-center border border-primary font-weight-bold" style="background-color:lavender;">
      <h2>PARTIKULAT</h2>
    </div>
    <div class="col-sm-6 text-center border border-primary font-weight-bold" style="background-color:lavender;">
      <h2>GAS</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center border border-primary p-5" style="background-color:lavenderblush;">          
      <div class="row p-1">
        <div class="col-sm-6">
          <div class="row p-3">
            <div class="col-sm border border-success p-3">
              <h3 class="text-position-center">PM10</h3>
            </div>
            <div class="col-sm border border-success text-center">
              <div class="row p-1">
                <div class="col-sm-12">
                  <h2 id="pm10">
                    
                  </h2>
                  <p>ppm</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row p-3">
            <div class="col-sm border border-success p-3">
              <h3 class="text-position-center">PM25</h3>
            </div>
            <div class="col-sm border border-success text-center">
              <div class="row p-1">
                <div class="col-sm-12">
                  <h2>
                    <?php
                      $get = substr($gas['PM25'], 2, 7);
                      echo round($get);
                    ?>
                  </h2>
                  <p>ppm</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 text-center border border-primary" style="background-color:lavenderblush;">
      <div class="row p-1">
        <div class="col-sm-6">
          <div class="row p-2">
            <div class="col-sm border border-success p-3">
              <h3 class="text-position-center">CO</h3>
            </div>
            <div class="col-sm border border-success text-center">
              <div class="row p-1">
                <div class="col-sm-12">
                  <h2><?= round($gas['AIN0'], 3) ?></h2>
                  <p>ppm</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row p-2">
            <div class="col-sm border border-success p-3">
              <h3 class="text-position-center">O3</h3>
            </div>
            <div class="col-sm border border-success text-center">
              <div class="row p-1">
                <div class="col-sm-12">
                  <h2><?= round($gas['AIN1'], 3) ?></h2>
                  <p>ppm</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row p-2">
            <div class="col-sm border border-success p-3">
              <h3 class="text-position-center">NO2</h3>
            </div>
            <div class="col-sm border border-success text-center">
              <div class="row p-1">
                <div class="col-sm-12">
                  <h2><?= round($gas['AIN2'], 3) ?></h2>
                  <p>ppm</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row p-2">
            <div class="col-sm border border-success p-3">
              <h3 class="text-position-center">VOC</h3>
            </div>
            <div class="col-sm border border-success text-center">
              <div class="row p-1">
                <div class="col-sm-12">
                  <h2><?= round($gas['AIN3'], 3) ?></h2>
                  <p>ppm</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 text-center border border-primary font-weight-bold" style="background-color:lavender;">
      <h2>CUACA</h2>
    </div>
  </div>
  <div class="row text-center border border-primary" style="background-color: lavenderblush">
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>KECEPATAN ANGIN</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>0</h3>
          <p>Km/jam</p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>ARAH ANGIN</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>293</h3>
          <p>WNM</p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>TEMPERATUR</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>25</h3>
          <p>Celcius</p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>TEKANAN</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>78</h3>
          <p>MBar</p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>CURAH HUJAN</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>112</h3>
          <p>mm/jam</p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>SOLAR RADIASI</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>64</h3>
          <p>watt/m2</p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="row p-1">
        <div class="col-sm-12 border border-success p-1">
          <h5>KELEMBABAN</h5>
        </div>
      </div>
      <div class="row p-1">
        <div class="col-sm-12">
          <h3>72</h3>
          <p>%</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>