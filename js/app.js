var app = angular.module("app",[]);

app.controller("controller",function($scope,$http) {
    var self = this;
    $scope.mode = "";
    
    self.price = 0;
    self.pc = {
        "cpu":{name: "??", price: "??",img:""},
        "mainboard":{name: "??", price: "??",img:""},
        "ram":{name: "??", price: "??",img:""},
        "vga":{name: "??", price: "??",img:""},
        "hdd":{name: "??", price: "??",img:""},
        "ssd":{name: "??", price: "??",img:""},
        "power_supply":{name: "??", price: "??",img:""},
        "case":{name: "??", price: "??",img:""}
    };
    
    self.typeSelect = function(type) {
        if($scope.mode == 'Case' ||$scope.mode == 'SSD' ||$scope.mode == 'HDD' ||$scope.mode == 'VGA'||$scope.mode == 'RAM' ) {
            self.filter.tag ="";
        }
        if(self.filter.tag.indexOf("" + type + "") == -1 ) {
            self.addType("" + type + "");
        }else {
            self.removeType("" + type + "");
        }
    }
    
    self.addType = function(type) {
        if(self.filter.tag.length == 0) {
            self.filter.tag = type;
        }else {
            self.filter.tag = self.filter.tag.concat("," + type);
        }
        self.get().then(function(response) {
            self.data[self.filter.part] = response.data;
            console.log(self.data);
        });;
    }
    
    self.callPrice = function() {
        self.price = 0;
        if(self.pc['cpu'].price != "??") {
            self.price = self.price + parseInt(self.pc['cpu'].price)
        }
        if(self.pc['mainboard'].price != "??") {
            self.price = self.price + parseInt(self.pc['mainboard'].price)
        }
        if(self.pc['vga'].price != "??") {
            self.price = self.price + parseInt(self.pc['vga'].price)
        }
        if(self.pc['ram'].price != "??") {
            self.price = self.price + parseInt(self.pc['ram'].price)
        }
        if(self.pc['hdd'].price != "??") {
            self.price = self.price + parseInt(self.pc['hdd'].price)
        }
        if(self.pc['ssd'].price != "??") {
            self.price = self.price + parseInt(self.pc['ssd'].price)
        }
        if(self.pc['power_supply'].price != "??") {
            self.price = self.price + parseInt(self.pc['power_supply'].price)
        }
        if(self.pc['case'].price != "??") {
            self.price = self.price + parseInt(self.pc['case'].price)
        }
        console.log(self.price);
    }
    
    self.export = function() {
//        html2canvas("#spec").then(function(canvas) {
////            var img = canvas.toDataURL("image/png");
////            console.log(img);
//            document.body.appendChild(canvas);
//        });
        
        html2canvas(document.getElementById("spec")).then(function(canvas) {
            var  img = canvas.toDataURL("image/png");
            ReImg.fromCanvas(canvas).downloadPng();
        });
    }

    
    self.removeType = function(type) {
        if(self.filter.tag.indexOf(type) == -1) {
//            console.log("not f")
            return
        }else {
//            console.log("f");
            var str = type + ",";
            if(self.filter.tag.indexOf(str) == -1 ) {
                str = "," + type;
                self.filter.tag= self.filter.tag.replace(str, "");
            }else {
                self.filter.tag= self.filter.tag.replace(str, "");
            }
            if(self.filter.tag.indexOf(type) != -1) { 
                self.filter.tag= self.filter.tag.replace(type, "");
            }
        }
        self.get().then(function(response) {
            self.data[self.filter.part] = response.data;
            console.log(self.data);
        });;
    }
    
    self.filter = {part:"",tag:""};
    self.data = {
        "CPU":[],
        "Mainboard":[],
        "Ram":[],
        "VGA":[],
        "hdd":[],
        "ssd":[],
        "power_supply":[],
        "case":[]
    }
    
    self.resetSelect = function() {
        self.filter.tag= "";
        self.get().then(function(response) {
            self.data[self.filter.part] = response.data;
            console.log(self.data);
        });;
    }
    
    self.choose = function(data) {
        var mode = $scope.mode.toLowerCase();
        self.pc[mode] = data;
        console.log(data);
        var modeLink = "";
        if(mode == "mainboard") {
            modeLink = "Mainboard";
        }else if(mode == "cpu") {
            modeLink = "CPU";
        }else if(mode == "vga") {
            modeLink = "VGA";
        }else if(mode == "ram") {
            modeLink = "RAM";
        }else if(mode == "ssd") {
            modeLink = "SSD";
        }else if(mode == "hdd") {
            modeLink = "HDD";
        }else if(mode == "power_supply") {
            modeLink = "Power_Supply";
        }else if(mode == "case") {
            modeLink = "Case";
        }else {
            modeLink = mode;
        }
        $('#' + mode+"_icon").attr("src", "images/" + modeLink + "/" + self.pc[mode].img + ".jpg");
//        console.log(self.pc);
        $("#select_pc").modal('hide');
        self.checkSocket();
        self.checkDDR();
        
        self.callPrice();
        console.log(self.pc);
        
    }
    
    self.get = function() {
        return $http.get("api.php?part=" + self.filter.part + "&tag=" + self.filter.tag);
    }
    
    self.checkSocket = function() {
        if((self.pc.mainboard.socket != self.pc.cpu.socket) && (self.pc.cpu.name != "??" && self.pc.mainboard.name != "??")) {
            $("#cpu_block").removeClass("btn-default");
            $("#mb_block").removeClass("btn-default");
            $("#cpu_block").addClass("btn-danger");
            $("#mb_block").addClass("btn-danger");
        }else {
            $("#cpu_block").addClass("btn-default");
            $("#mb_block").addClass("btn-default");
            $("#cpu_block").removeClass("btn-danger");
            $("#mb_block").removeClass("btn-danger");
        }
    }
    
    self.checkDDR = function() {
        if((self.pc.mainboard.ddr != self.pc.ram.ddr) && (self.pc.ram.name != "??" && self.pc.mainboard.name != "??")) {
            $("#ram_block").removeClass("btn-default");
            $("#mb_block").removeClass("btn-default");
            $("#ram_block").addClass("btn-danger");
            $("#mb_block").addClass("btn-danger");
        }else {
            $("#ram_block").addClass("btn-default");
            $("#mb_block").addClass("btn-default");
            $("#ram_block").removeClass("btn-danger");
            $("#mb_block").removeClass("btn-danger");
        }
    }
    
    self.select = function(name) {
        self.filter.part = name;
        $scope.mode = name;
        self.filter.tag = "";
        console.log(name);
        self.get().then(function(response) {
            self.data[self.filter.part] = response.data;
            console.log(self.data[self.filter.part]);
            self.filter.tag = "";
            if(name == "Mainboard" && self.pc.cpu.name != "??") {
                self.typeSelect(self.pc.cpu.socket);
            }
            if(name == "CPU" && self.pc.mainboard.name != "??") {
                self.typeSelect(self.pc.mainboard.socket);
            }
            if(name == "RAM" && self.pc.mainboard.name != "??") {
                self.typeSelect(self.pc.mainboard.ddr);
            }
            $("#select_pc").modal('show');
        });
        
    }
    
    self.fget = function() {
        return $http.get("api.php?part=" + self.filter.part);
    }
    
    self.firstRun = function() {
        self.filter.part = "VGA";
        self.fget().then(function(response) {
            self.data[self.filter.part] = response.data;
        });;
        
        console.log(self.data);
    }
    self.firstRun();
});