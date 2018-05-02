@extends('layouts.app')

@section('title', 'FAQ\'s')

@section('head')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/configurator.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Configurator'])
      <form>
        <div class="form-group">
          <h3 style="display: inline; color: #f8941e;"><strong>The configurator</strong></h3> is a place where you can fully customize a desktop computer.
          <br>
          Feel free to try different combinations and check some of the tooltips that we provide.
        </div>
      </form>

      <form>
        <!-- Outer Form Division -->
        <h2 class="sectionTitle"> Components</h2>
        <div id="components" class="form-group">
          <!-- Item Division CASE-->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="caseInput" class="mainLabel">
                Case
              </label>
              <select id="caseInput" class="form-control" name="pc-case">
                <option value="">None</option>
                @foreach($productsByCategory[1] as $product)
                  <option value="{{$product->price}}">{{$product->title}} ({{$product->price}}€)</option>
                @endforeach
              </select>
              <small id="emailHelp" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="10,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>

          <br> <hr> <br>
          <!-- Item Division Cooler -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="coolerInput" class="mainLabel">
                Cooler
              </label>
              <select id="coolerInput" class="form-control" name="cooler">
                <option value="">None</option>
                @foreach($productsByCategory[2] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="coolerInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="5,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Hard Disk Drive -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="hddInput" class="mainLabel">
                Hard Disk Drive
              </label>
              <select id="hddInput" class="form-control" name="hdd">
                <option value="">None</option>
                @foreach($productsByCategory[3] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="hddInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Solid State Drive -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="ssdInput" class="mainLabel">
                Solid State Drive
              </label>
              <select id="ssdInput" class="form-control" name="ssd">
                <option value="">None</option>
                @foreach($productsByCategory[4] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="ssdInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division PSU -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="psuInput" class="mainLabel">
                Power Supply Unit
                <a href="#psuTips" class="toggle-tips" data-toggle="collapse"><i class="fas fa-angle-double-down"></i> Tips</a>
                <div id="psuTips" class="collapse">
                  PSU(Power Supply Unit)
                </div>
              </label>
              <select id="psuInput" class="form-control" name="psu">
                <option value="">None</option>
                @foreach($productsByCategory[5] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="psuInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Graphics Card -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="gpuInput" class="mainLabel">
                Graphics Card
                <a href="#gpuTips" class="toggle-tips" data-toggle="collapse"><i class="fas fa-angle-double-down"></i> Tips</a>
                <div id="gpuTips" class="collapse">
                  The Graphics Card is a board which includes all the necessary components
                  to do graphic processing, these processors are required mainly for gaming
                  but in general they can perform very distributed tasks for their high amount
                  of cores and they do these tasks very fast as they only process specialized
                  workloads. If you don't need to do any specialized workloads you might want
                  to consider a CPU with an integrated graphics processor as it can reduce
                  your system's overall cost. Something to note here is the VRAM available.
                  Cards with the same processor have different amounts of memory available
                  as each task requires specific memory space, you should take your use in
                  account when choosing between memory amount.
                </div>
              </label>
              <select id="gpuInput" class="form-control" name="gpu">
                <option value="">None</option>

                @foreach($productsByCategory[6] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="gpuInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division RAM Memory -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="ramInput" class="mainLabel">
                RAM Memory
                <a href="#ramTips" class="toggle-tips" data-toggle="collapse"><i class="fas fa-angle-double-down"></i> Tips</a>
                <div id="ramTips" class="collapse">
                  RAM(Random Access Memory)
                </div>
              </label>
              <select id="ramInput" class="form-control" name="ram">
                <option value="">None</option>

                @foreach($productsByCategory[7] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="ramInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Motherboard -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="mbInput" class="mainLabel">
                Motherboard
                <a href="#mbTips" class="toggle-tips" data-toggle="collapse"><i class="fas fa-angle-double-down"></i> Tips</a>
                <div id="mbTips" class="collapse">
                  Motherboard
                </div>
              </label>
              <select id="mbInput" class="form-control" name="mb">
                <option value="">None</option>

                @foreach($productsByCategory[8] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="mbInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division CPU -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="mbInput" class="mainLabel">
                CPU
                <a href="#cpuTips" class="toggle-tips" data-toggle="collapse"><i class="fas fa-angle-double-down"></i> Tips</a>
                <div id="cpuTips" class="collapse">
                  A CPU(Central Processing Unit) is the required processor for a computer
                  to operate. A CPU consists in one or more independant processing cores
                  but they can still work together so the more cores your CPU has the more
                  calculations you can make per time unit. Each core can have one
                  or two threads(separate logical processing units) so as with cores the
                  same rule aplies. Intel developed Hyperthreading technology and AMD "...".
                  If your CPU has one of these technology then the number of threads in your
                  CPU is 2 per core otherwise it's 1. It's worth noting that some CPU's
                  include a graphics processor aswell.
                  Suggestions:
                  <ul>
                    <li>
                      High Performance (16+ Threads)
                      <p>High perfomance CPU's are ideal for distributed workload that can
                        make use of all the available threads. These workload are presented
                        by video and image rendering
                      </p>
                    </li>
                    <li>
                      Medium Performance (8-12 Threads)
                      <p>
                        Ideal for a distributed workload, these CPU's are good for gaming
                        and multitasking as they have high clock speeds which increase the
                        speed of light workload and still have enough processing capacity
                        to do some heavy workloads.
                      </p>
                    </li>
                    <li>
                      Low Performance (8- Threads)
                      <p>
                        These CPU's are often used for light workloads that won't require
                        much processing power. Their selling points are lower cost and power
                        comsumption. Ideal for medium multitasking and lower-end gaming.
                      </p>
                    </li>
                  </ul>
                </div>
              </label>
              <select id="mbInput" class="form-control" name="mb">
                <option value="">None</option>

                @foreach($productsByCategory[9] as $product)
                  <option>{{$product->title}}</option>
                @endforeach
              </select>
              <small id="mbInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
        </div>
        <!-- Outer Form Division -->
        <h2 class="sectionTitle">Periferals</h2>
        <div id="periferals" class="form-group">
          <!-- Item Division CASE-->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="caseInput" class="mainLabel">
                Case
              </label>
              <select id="caseInput" class="form-control" name="pc-case">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="emailHelp" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Cooler -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="coolerInput" class="mainLabel">
                Cooler
              </label>
              <select id="coolerInput" class="form-control" name="cooler">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="coolerInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Hard Disk Drive -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="hddInput" class="mainLabel">
                Hard Disk Drive
              </label>
              <select id="hddInput" class="form-control" name="hdd">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="hddInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Solid State Drive -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="ssdInput" class="mainLabel">
                Solid State Drive
              </label>
              <select id="ssdInput" class="form-control" name="ssd">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="ssdInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division PSU -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="psuInput" class="mainLabel">
                Power Supply Unit
                <div class="overlay hidden">
                  PSU(Power Supply Unit)
                </div>
                <a href="#" class="toggle-tips"><i class="fas fa-angle-double-down"></i> Tips</a>
              </label>
              <select id="psuInput" class="form-control" name="psu">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="psuInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Graphics Card -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="gpuInput" class="mainLabel">
                Graphics Card
                <a href="#" class="toggle-tips"><i class="fas fa-angle-double-down"></i> Tips</a>
              </label>
              <select id="gpuInput" class="form-control" name="gpu">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="gpuInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division RAM Memory -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="ramInput" class="mainLabel">
                RAM Memory
                <div class="overlay hidden">
                  RAM(Random Access Memory)
                </div>
                <a href="#" class="toggle-tips"><i class="fas fa-angle-double-down"></i> Tips</a>
              </label>
              <select id="ramInput" class="form-control" name="ram">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="ramInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division Motherboard -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="mbInput" class="mainLabel">
                Motherboard
                <div class="overlay hidden">
                  Motherboard
                </div>
                <a href="#" class="toggle-tips"><i class="fas fa-angle-double-down"></i> Tips</a>
              </label>
              <select id="mbInput" class="form-control" name="mb">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="mbInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
          <br> <hr> <br>
          <!-- Item Division CPU -->
          <div class="form-row">
            <div class="col-xl-6 col-sm-12">
              <label for="mbInput" class="mainLabel">
                CPU
                <a href="#" class="toggle-tips"><i class="fas fa-angle-double-down"></i> Tips</a>
              </label>
              <select id="mbInput" class="form-control" name="mb">
                <option value="">None</option>

                <option value="4054_4054" data-html="<img src='/Client/CL000000/Temp/CAIXA1306_1_636448035191081453_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1306" data-link="/pt-PT/produto/4054/Caixa-Aerocool-AERO-300-Preta/AERO300.html" data-part="AERO300" data-stock="yellow" data-price="33.900030">Caixa Aerocool AERO-300 Preta (33,90 €)</option>

                <option value="4055_4055" data-html="<img src='/Client/CL000000/Temp/CAIXA1323_1_636448035193181456_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1323" data-link="/pt-PT/produto/4055/Caixa-Aerocool-AERO-300-Window-Preta/AERO300FAW.html" data-part="AERO300FAW" data-stock="blue" data-price="40.999959">Caixa Aerocool AERO-300 Window Preta (41,00 €)</option>

                <option value="4060_4060" data-html="<img src='/Client/CL000000/Temp/CAIXA1177_1_636448033900479646_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1177" data-link="/pt-PT/produto/4060/Caixa-Aerocool-AERO-800-Window-Preta/AERO800BK.html" data-part="AERO800BK" data-stock="blue" data-price="67.900059">Caixa Aerocool AERO-800 Window Preta (67,90 €)</option>

                <option value="4059_4059" data-html="<img src='/Client/CL000000/Temp/CAIXA1325_1_636448035193781457_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1325" data-link="/pt-PT/produto/4059/Caixa-Aerocool-BattleHawk-Branca/BATTLEHAWKWH.html" data-part="BATTLEHAWKWH" data-stock="blue" data-price="58.900026">Caixa Aerocool BattleHawk Branca (58,90 €)</option>

                <option value="30842_11543" data-html="<img src='/Client/CL000000/Temp/CAIXA1357_1_636448035616282048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1357" data-link="/pt-PT/produto/30842/Caixa-Aerocool-CyberX/CYBERX.html" data-part="CYBERX" data-stock="blue" data-price="39.899970">Caixa Aerocool CyberX (39,90 €)</option>

                <option value="30841_11542" data-html="<img src='/Client/CL000000/Temp/CAIXA1356_1_636448035616082048_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1356" data-link="/pt-PT/produto/30841/Caixa-Aerocool-CyberX-Advance/CYBERXAD.html" data-part="CYBERXAD" data-stock="blue" data-price="46.900023">Caixa Aerocool CyberX Advance (46,90 €)</option>

                <option value="31971_12673" data-html="<img src='/Client/CL000000/Temp/CAIXA1408_1_636523300096187892_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1408" data-link="/pt-PT/produto/31971/Caixa-Aerocool-Cylon-RGB-Flow-Lighting/CYLON.html" data-part="CYLON" data-stock="yellow" data-price="40.999959">Caixa Aerocool Cylon RGB Flow Lighting (41,00 €)</option>

                <option value="31972_12674" data-html="<img src='/Client/CL000000/Temp/CAIXA1409_1_636523300096500393_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1409" data-link="/pt-PT/produto/31972/Caixa-Aerocool-DS-230/DS230BK.html" data-part="DS230BK" data-stock="blue" data-price="94.900035">Caixa Aerocool DS 230 (94,90 €)</option>

                <option value="4053_4053" data-html="<img src='/Client/CL000000/Temp/CAIXA957_1_636448033258878748_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA957" data-link="/pt-PT/produto/4053/Caixa-Aerocool-GT-Advance-Preta/GTADBK.html" data-part="GTADBK" data-stock="blue" data-price="36.900000">Caixa Aerocool GT Advance Preta (36,90 €)</option>

                <option value="30838_11539" data-html="<img src='/Client/CL000000/Temp/CAIXA1361_1_636448035617482050_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1361" data-link="/pt-PT/produto/30838/Caixa-Aerocool-Project-7-P7-C0-Pro/P7C0PRO.html" data-part="P7C0PRO" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C0 Pro (112,90 €)</option>

                <option value="4063_4063" data-html="<img src='/Client/CL000000/Temp/CAIXA1328_1_636448035194681458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1328" data-link="/pt-PT/produto/4063/Caixa-Aerocool-Project-7-P7-C1-Branca/P7C1WG.html" data-part="P7C1WG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Branca (112,90 €)</option>

                <option value="4062_4062" data-html="<img src='/Client/CL000000/Temp/CAIXA1327_1_636448035194381458_crop_100x100_False_False.jpg' class='img-center img-responsive'>" data-ref="CAIXA1327" data-link="/pt-PT/produto/4062/Caixa-Aerocool-Project-7-P7-C1-Preta/P7C1BG.html" data-part="P7C1BG" data-stock="blue" data-price="112.899978">Caixa Aerocool Project 7 P7-C1 Preta (112,90 €)</option>

              </select>
              <small id="mbInfo" class="form-text text-muted"><b>PN</b>:&ltpart number&gt , <b>REF</b>:&ltreference&gt</small>
            </div>
            <div id="labelUnity" class="col-xl-2 col-sm-2 col-6">
              <label  for="caseUnitPrice">Unit</label>
              <input id="caseUnitPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
            <div class="col-xl-1 col-sm-2 col-4">
              <label for="caseAmount">&zwnj;</label>
              <input id="caseAmount" type="number" class="form-control" value="1" min="1" max="100" step="1">
            </div>
            <div class="col-xl-2 col-sm-4 col-6">
              <label for="caseAvalability">&zwnj;</label>
              <input id="caseAvalability" type="text" readonly class="form-control-plaintext" value="Available">
            </div>
            <div class="col-xl-1 col-sm-2 col-6">
              <label for="caseTotalPrice">&zwnj;</label>
              <input id="caseTotalPrice" type="text" readonly class="form-control-plaintext" value="0,00€">
            </div>
          </div>
        </div>
        <!-- Outer Form Division -->
        <h3 class="sectionTitle total"><span>0,00€</span></h3>
        <form/>
    @endsection
