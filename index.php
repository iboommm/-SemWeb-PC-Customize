<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>PC Component Optimize!</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/angular.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript" src="js/html2canvas.js"></script>
    <script type="text/javascript" src="js/reimg.js"></script>
    
    
    <script>
        function downloadCanvasAsPng() {
            ReImg.fromCanvas(document.querySelector('canvas')).downloadPng();
        }
    </script>
</head>
<body ng-controller="controller as cons">

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-bar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">PC Component Optimize!</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menu-bar">
      
      <ul class="nav navbar-nav navbar-right">
        <div class="form-group" style="margin-top:10px;">
            <button class="btn btn-success" ng-click="cons.export()" id="dl" >Export</button>
          </div>
      </ul>
    </div>
  </div>
</nav>

<div id="spec" class="container" >
    <div class="col-md-8 col-md-offset-2" style="border:1px #000 solid">
       <div class="col-sm-12 col-md-12">
            <div id="cpu_block" class="col-md-4 col-sm-6 component-icon btn btn-default" ng-click="cons.select('CPU')">
                <div class="col-xs-4 text-right"><img id="cpu_icon" src="images/icons/cpu.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">CPU <br>{{ cons.pc.cpu.name }} <br>Price : {{ cons.pc.cpu.price }} </div>
            </div>
            <div id="mb_block" class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('Mainboard')"> 
               <div class="col-xs-4 text-right"><img id="mainboard_icon" src="images/icons/mb.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">Mainboard <br>{{ cons.pc.mainboard.name }} <br>Price : {{ cons.pc.mainboard.price }}  </div>
            </div>
            <div id="ram_block" class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('RAM')">
                <div class="col-xs-4 text-right"><img id="ram_icon" src="images/icons/ram.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">RAM<br>{{ cons.pc.ram.name }} <br>Price : {{ cons.pc.ram.price }} </div>
            </div>
            <div class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('VGA')">
                <div class="col-xs-4 text-right"><img id="vga_icon" src="images/icons/vga.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">VGA<br>{{ cons.pc.vga.name }} <br>Price : {{ cons.pc.vga.price }} </div>
            </div>
            <div class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('SSD')">
                <div class="col-xs-4 text-right"><img id="ssd_icon" src="images/icons/ssd.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">SSD<br>{{ cons.pc.ssd.name }} <br>Price : {{ cons.pc.ssd.price }} </div>
            </div>
            <div class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('HDD')">
                <div class="col-xs-4 text-right"><img id="hdd_icon" src="images/icons/hdd.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">HDD<br>{{ cons.pc.hdd.name }} <br>Price : {{ cons.pc.hdd.price }} </div>
            </div>
            <div class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('Power_Supply')">
                <div class="col-xs-4 text-right"><img id="power_supply_icon" src="images/icons/ps.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">Supply <br>{{ cons.pc.power_supply.name }} <br>Price : {{ cons.pc.power_supply.price }}  </div>
            </div>
            <div class="col-md-4 col-sm-6 component-icon  btn btn-default"  ng-click="cons.select('Case')">
                <div class="col-xs-4 text-right"><img id="case_icon" src="images/icons/case.png" height="60px" alt=""></div>
                <div class="col-xs-8 text-left">Case<br>{{ cons.pc.case.name }} <br>Price : {{ cons.pc.case.price }}  </div>
            </div>
            <div class="col-md-4 col-sm-6 success" style="font-size:35px;"> Price : {{ cons.price + 0  | number }} THB</div>
        </div>
    </div>
</div>


<div class="modal fade" id="select_pc" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ mode.toUpperCase() }} {{ cons.filter.tag }}</h4>
      </div>
     <div class="modal-body">
         <div class="col-md-12">
              <button class="btn btn-default" ng-click="cons.typeSelect('Business')">Business</button>
              <button class="btn btn-default" ng-click="cons.typeSelect('Gaming')">Gaming</button>
              <button class="btn btn-default" ng-click="cons.typeSelect('Render')">Render</button>       | 
              <button class="btn btn-default" ng-show="mode=='CPU'" ng-click="cons.typeSelect('INTEL');cons.removeType('AMD')">Intel</button>
              <button class="btn btn-default" ng-show="mode=='CPU'" ng-click="cons.typeSelect('AMD');cons.removeType('INTEL')">AMD</button>
              <button class="btn btn-default" ng-show="mode=='Case'" ng-click="cons.typeSelect('ITX')">ITX</button>
              <button class="btn btn-default" ng-show="mode=='Case'" ng-click="cons.typeSelect('MATX')">M-ATX</button>
              <button class="btn btn-default" ng-show="mode=='Case'" ng-click="cons.typeSelect('ATX')">ATX</button>
              <button class="btn btn-default" ng-show="mode=='Case'" ng-click="cons.typeSelect('EATX')">E-ATX</button>
              <button class="btn btn-default" ng-show="mode=='VGA'" ng-click="cons.typeSelect('GTX')">Nvidia</button>
              <button class="btn btn-default" ng-show="mode=='VGA'" ng-click="cons.typeSelect('RX')">AMD</button>
              
              <button class="btn btn-default" ng-show="mode=='Mainboard'" ng-click=";cons.removeType('AM3PLUS');cons.removeType('FM2PLUS');cons.typeSelect('1151')">LGA1151</button>
              <button class="btn btn-default" ng-show="mode=='Mainboard'" ng-click="cons.removeType('FM2PLUS');cons.removeType('1151');cons.typeSelect('AM3PLUS');">AM3+</button>
              <button class="btn btn-default" ng-show="mode=='Mainboard'" ng-click="cons.removeType('1151');cons.removeType('AM3PLUS');cons.typeSelect('FM2PLUS');">FM2+</button>
              
              <button class="btn btn-default" ng-show="mode=='RAM'" ng-click="cons.typeSelect('DDR3')">DDR3</button>
              <button class="btn btn-default" ng-show="mode=='RAM'" ng-click="cons.typeSelect('DDR4')">DDR4</button>
              <button class="btn btn-default" ng-show="mode=='SSD'" ng-click="cons.typeSelect('M.2')">M.2</button>
              <button class="btn btn-default" ng-show="mode=='SSD'" ng-click="cons.typeSelect('SATA')">SATA</button>
              <button class="btn btn-default" ng-click="cons.resetSelect()">Reset</button>
         </div>
        <div class="col-md-12" >
            <div  class="component-icon " ng-repeat="a in cons.data[mode]" ng-click="cons.choose(a)">
              <div class="col-xs-3 text-right">
                   <img src="images/{{mode}}/{{a.img}}.jpg" height="60px" alt="">
               </div>
               <div class="col-xs-9 text-left"  >
                    Name : {{a.name}} <br>
                    Price : {{a.price}}
                </div>
            </div>
        </div>
        &nbsp;
     </div>
    </div>
  
  </div>
</div>

</body>
</html>