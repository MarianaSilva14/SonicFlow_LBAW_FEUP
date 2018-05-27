@extends('layouts.app')

@section('title', 'Contact Us')

@section('head')
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Comparator'])
<br>
<div class="form-group row">
  <label for="image" class="col-sm-3 col-form-label"> ‌ </label>
  <div class="col-sm-2 thumbnails">
    <i class="fas fa-times"></i>
    <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/fa/44/14/1328378/1505-1.jpg" alt="100x100" class="img-fluid">
    <p> Portátil Acer Aspire </p>
  </div>

  <div class="col-sm-2 thumbnails">
    <i class="fas fa-times"></i>
    <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/01/41/12/1196289/1505-1/tsp20170623090030/Apple-MacBook-Pro-15-Retina-i7-2-8GHz-16GB-1TB-Radeon-Pro-555-com-Touch-Bar-e-Touch-ID-Cinzento-Sideral.jpg" alt="100x100" class="img-fluid">
    <p> Apple MacBook Pro 15 </p>
  </div>
  <div class="col-sm-2 thumbnails">
    <i class="fas fa-times"></i>
    <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/22/05/13/1246498/1505-1.jpg" alt="100x100" class="img-fluid">
    <p> Portátil Asus </p>
  </div>

  <div class="col-sm-2 thumbnails">
    <i class="fas fa-times"></i>
    <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/01/41/12/1196289/1505-1/tsp20170623090030/Apple-MacBook-Pro-15-Retina-i7-2-8GHz-16GB-1TB-Radeon-Pro-555-com-Touch-Bar-e-Touch-ID-Cinzento-Sideral.jpg" alt="100x100" class="img-fluid">
    <p> Apple MacBook Pro 17 </p>
  </div>
</div>

<form class="spec">

  <legend> Summary </legend>

  <div class="form-group row">
    <label for="screenSize" class="col-sm-3 col-form-label">Screen Size</label>
    <p class="col-sm-2">23.8 inches</p>
    <p class="col-sm-2">23.8 inches</p>
    <p class="col-sm-2">23.8 inches</p>
    <p class="col-sm-2">23.8 inches</p>
  </div>

  <div class="form-group row">
    <label for="maxScreenRes" class="col-sm-3 col-form-label">Screen Resolution</label>
    <p class="col-sm-2">1920 x 1080 pixels </p>
    <p class="col-sm-2">1920 x 1080 pixels </p>
    <p class="col-sm-2">1920 x 1080 pixels </p>
    <p class="col-sm-2">1920 x 1080 pixels </p>
  </div>

  <div class="form-group row">
    <label for="processor" class="col-sm-3 col-form-label">Processor</label>
    <p class="col-sm-2">2.4 GHz Intel Core i5</p>
    <p class="col-sm-2">2.4 GHz Intel Core i5</p>
    <p class="col-sm-2">2.4 GHz Intel Core i5</p>
    <p class="col-sm-2">2.4 GHz Intel Core i5</p>
  </div>

  <div class="form-group row">
    <label for="ram" class="col-sm-3 col-form-label">Ram</label>
    <p class="col-sm-2">12 GB DDR4</p>
    <p class="col-sm-2">12 GB DDR4</p>
    <p class="col-sm-2">12 GB DDR4</p>
    <p class="col-sm-2">12 GB DDR4</p>
  </div>

  <div class="form-group row">
    <label for="hardDrive" class="col-sm-3 col-form-label">Hard Drive</label>
    <p class="col-sm-2">1000 GB Mechanical Hard Drive</p>
    <p class="col-sm-2">1000 GB Mechanical Hard Drive</p>
    <p class="col-sm-2">1000 GB Mechanical Hard Drive</p>
    <p class="col-sm-2">1000 GB Mechanical Hard Drive</p>
  </div>

  <div class="form-group row">
    <label for="graphics" class="col-sm-3 col-form-label">Graphics Coprocessor</label>
    <p class="col-sm-2">Intel 630</p>
    <p class="col-sm-2">Intel 630</p>
    <p class="col-sm-2">Intel 630</p>
    <p class="col-sm-2">Intel 630</p>
  </div>

  <div class="form-group row">
    <label for="cardDes" class="col-sm-3 col-form-label">Card Description</label>
    <p class="col-sm-2">Integrated</p>
    <p class="col-sm-2">Integrated</p>
    <p class="col-sm-2">Integrated</p>
    <p class="col-sm-2">Integrated</p>
  </div>

  <div class="form-group row">
    <label for="usb2" class="col-sm-3 col-form-label">Number of USB 2.0 Ports</label>
    <p class="col-sm-2">1</p>
    <p class="col-sm-2">1</p>
    <p class="col-sm-2">1</p>
    <p class="col-sm-2">1</p>
  </div>

  <div class="form-group row">
    <label for="usb3" class="col-sm-3 col-form-label">Number of USB 3.0 Ports</label>
    <p class="col-sm-2">4</p>
    <p class="col-sm-2">4</p>
    <p class="col-sm-2">4</p>
    <p class="col-sm-2">4</p>
  </div>

</form>
<br><br>
<form class="spec">

  <legend> Other Technical Details </legend>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Brand Name</label>
    <p class="col-sm-2">Apple</p>
    <p class="col-sm-2">Apple</p>
    <p class="col-sm-2">Apple</p>
    <p class="col-sm-2">Apple</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Series</label>
    <p class="col-sm-2">Pro</p>
    <p class="col-sm-2">Pro</p>
    <p class="col-sm-2">Pro</p>
    <p class="col-sm-2">Pro</p>
  </div>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Item model number</label>
    <p class="col-sm-2">AZ3-715-ACKi5</p>
    <p class="col-sm-2">AZ3-715-ACKi5</p>
    <p class="col-sm-2">AZ3-715-ACKi5</p>
    <p class="col-sm-2">AZ3-715-ACKi5</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Hardware Platform</label>
    <p class="col-sm-2">PC</p>
    <p class="col-sm-2">PC</p>
    <p class="col-sm-2">PC</p>
    <p class="col-sm-2">PC</p>
  </div>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Operating System</label>
    <p class="col-sm-2">Windows 10</p>
    <p class="col-sm-2">Windows 10</p>
    <p class="col-sm-2">Windows 10</p>
    <p class="col-sm-2">Windows 10</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Item Weight</label>
    <p class="col-sm-2">22.6 pounds</p>
    <p class="col-sm-2">22.6 pounds</p>
    <p class="col-sm-2">22.6 pounds</p>
    <p class="col-sm-2">22.6 pounds</p>
  </div>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Product Dimensions</label>
    <p class="col-sm-2">23.3 x 1.4 x 18.4 inches</p>
    <p class="col-sm-2">23.3 x 1.4 x 18.4 inches</p>
    <p class="col-sm-2">23.3 x 1.4 x 18.4 inches</p>
    <p class="col-sm-2">23.3 x 1.4 x 18.4 inches</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Item Dimensions L x W x H</label>
    <p class="col-sm-2">23.34 x 1.42 x 18.45 inches</p>
    <p class="col-sm-2">23.34 x 1.42 x 18.45 inches</p>
    <p class="col-sm-2">23.34 x 1.42 x 18.45 inches</p>
    <p class="col-sm-2">23.34 x 1.42 x 18.45 inches</p>
  </div>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Color</label>
    <p class="col-sm-2">grey</p>
    <p class="col-sm-2">grey</p>
    <p class="col-sm-2">grey</p>
    <p class="col-sm-2">grey</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Processor Brand</label>
    <p class="col-sm-2">Intel</p>
    <p class="col-sm-2">Intel</p>
    <p class="col-sm-2">Intel</p>
    <p class="col-sm-2">Intel</p>
  </div>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Processor Count</label>
    <p class="col-sm-2">1</p>
    <p class="col-sm-2">1</p>
    <p class="col-sm-2">1</p>
    <p class="col-sm-2">1</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Computer Memory Type</label>
    <p class="col-sm-2">DDR4 SDRAM</p>
    <p class="col-sm-2">DDR4 SDRAM</p>
    <p class="col-sm-2">DDR4 SDRAM</p>
    <p class="col-sm-2">DDR4 SDRAM</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Hard Drive Interface</label>
    <p class="col-sm-2">ATA</p>
    <p class="col-sm-2">ATA</p>
    <p class="col-sm-2">ATA</p>
    <p class="col-sm-2">ATA</p>
  </div>

  <div class="form-group row">
    <label for="brand" class="col-sm-3 col-form-label">Hard Drive Rotational Speed</label>
    <p class="col-sm-2">5400 RPM</p>
    <p class="col-sm-2">5400 RPM</p>
    <p class="col-sm-2">5400 RPM</p>
    <p class="col-sm-2">5400 RPM</p>
  </div>

  <div class="form-group row">
    <label for="series" class="col-sm-3 col-form-label">Optical Drive Type</label>
    <p class="col-sm-2">DVD-RW</p>
    <p class="col-sm-2">DVD-RW</p>
    <p class="col-sm-2">DVD-RW</p>
    <p class="col-sm-2">DVD-RW</p>
  </div>

</form>
@endsection
