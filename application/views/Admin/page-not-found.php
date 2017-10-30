
<style>
.page-404 {
    position: relative;
    width: 350px;
    height: 200px;
    margin: 100px auto;
    text-align: center;
}

.text-404 {
    font-size: 138px;
    background: #e9e3dd;
    background-image: url(https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQTdWeWNteABnbzguiXSBxmfc8Z8nh_HHoWoK35QL81x4HnpVmgvQ);
    background-repeat: no-repeat;
    background-size: 200% 200%;
    background-position: 100% 100%;
    -webkit-animation: square 3s linear infinite;
    -ms-animation: square 3s linear infinite;
    animation: square 3s linear infinite;
    -webkit-background-clip: text;
    color: transparent;
    text-align: center;
    line-height: 200px;
    position: relative;
}
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?PHP echo base_url('dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Data not found on this request</li>
			</ol>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-lg-12 content-div" >
				<div class="panel panel-default">
					
					<div class="panel-body ">
                    
   <div class="page-404">
    <p class="text-404">404</p>
<?PHP
$this->session->set_userdata('selectedSchool','');	
$this->session->set_userdata('selectedMandal','');
$this->session->set_userdata('selectedDistrict','');
$this->session->set_userdata('SelectedExamcenter','');

?>
    <h2>Ooops!</h2>
    <p>Data not found on this request <br><a href="<?PHP echo base_url($routeto)?>">Return Back</a></p>
  </div>
  
                        
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
        
        
		
	</div>