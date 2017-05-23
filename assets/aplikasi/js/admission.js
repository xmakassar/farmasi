$(document).ready(function(){
	setInterval(function(){
		getTotalPrint(loket_login);
	},3000);
	getNomorAntrian();
});

function setLoket() {
	bootbox.prompt({ 
	  size: "small",
	  title: "No Loket", 
	  inputType: "select",
	  inputOptions: [
	        {
	            text: 'A',
	            value: 'A',
	        },
	        {
	            text: 'B',
	            value: 'B',
	        },
	        {
	            text: 'C',
	            value: 'C',
	        },
	        {
	            text: 'D',
	            value: 'D',
	        },
	        {
	            text: 'E',
	            value: 'E',
	        }
	   ], 
	  callback: function(result){ 
	  	if (result) {
	  		//$("#loket").text(result.toUpperCase());
	  		$.ajax({
	  			url : base_url+"panel/setNomorLoket",
				method : "POST",
				data : {"loket":result.toUpperCase()},
				success : function (e) {
					$("#loket").text(e.toUpperCase());
					loket = e.toUpperCase();
				}
	  		});
	  	}
	  }
	})
}

function resetPrint() {
	bootbox.confirm("Yakin Mereset Antrian Ke 0", function(result) {
		if (result) {
			$.ajax({
				url : base_url+"panel/resetNomorPrint",
				method : "POST",
				success : function () {
					reload_table();
				}
			});
		}
	
	});
}

function resetAntrian() {
	bootbox.confirm("Yakin Mereset Antrian Ke 0", function(result) {
		if (result) {
			$.ajax({
				url : base_url+"panel/resetNomorAntrian/",
				method : "POST",
				data : {"loket_login":loket_login},
				success : function () {
					bootbox.alert("Reset Data Berhasil");
					$("#nomor_antrian").text("0");	
				}
			});
		}
	
	});
}

function getTotalPrint(pil) {
	$.ajax({
		url 	 : base_url+"panel/getNomorPrint",
		method 	 : "POST",
		dataType : "JSON",
		success  : function (e) {
			var hasil = e.farmasi;
			$("#total_print").text(hasil);
		}
	});
}

function getNomorAntrian() {
	$.ajax({
		url : base_url+"panel/getNomorAntrian/"+loket_login,
		method : "POST",
		data : {"loket_login": loket_login},
		success : function (e) {
			$("#nomor_antrian").text(e);	
		}
	});
}

function jump() {
	bootbox.prompt({ 
	  size: "small",
	  title: "Nomor yang Di Panggil", 
	  inputType: "number", 
	  callback: function(result){ 
	  	if (result) {
	  		$("#nomor_antrian").text(result);
	  	}
	  }
	})
}

function next() {
	$.ajax({
		url : base_url+"panel/setNomorAntrian",
		method : "POST",
		data : {"loket_login": loket_login},
		dataType : "json",
		success : function (e) {
			if (e.status) {
				$("#nomor_antrian").text(e.nomor);
			} else {
				bootbox.alert("kelewatan yee");
			}
		},
		error : function (e) {
			console.log(e);
		}
	});
}

function call() {
	var nomor_antrian = $("#nomor_antrian").text();
	$.ajax({
		url : base_url+"panel/setQueue",
		method : "POST",
		data : {"nomor_antrian":nomor_antrian,"loket":loket,"loket_login":loket_login},
		success : function (e) {
			bootbox.alert("Paggilan Telah Masuk ke Waiting List");
		}
	});
}

