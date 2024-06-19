
document.addEventListener('DOMContentLoaded',function(){


	fetch("fetchAttendence.php",{
		method:"POST",
	})
	.then(response=>response.text())
	.then(data=>{

		document.getElementById('attendence_table').innerHTML=data;
      
	})
	.catch(error=>{console.error("error"+error)})

	
})