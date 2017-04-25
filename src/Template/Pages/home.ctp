
<div class="card" style="padding:20px;" >  
<div>

<h1> 
Welcome: <?php print $this->request->session()->read('Auth.User.first_name'); ?> </h1>
</div>
<br>
<div>
<a href="games/game" style=" color: #FFFFFF;
    text-decoration: none;"><button class="btn" style="width:100%"> Play Civics Game  </button></a>
</div>
<br>


</div>