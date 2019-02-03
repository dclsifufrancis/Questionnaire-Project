

<!-- 1h07 -->













    <!-- header -->
    <?php include('./include/header.php');?>


    <!-- LOGO -->
    <div class="p-3 mb-2 bg-light text-dark">
    </div>


    <!-- Main -->
    <div class="container">

        <div class="p-3 mb-2 bg-primary text-white">
            <h1 class="text-center">MINI-QUIZ</h1>
        </div>

        <div class="p-3 mb-2 bg-dark text-white">
            <p>Derniers ajouts & les mieux notés</p>
        </div>

        <div class="alert alert-ligth" role="alert">
            <ul class="list-group">
                <li class="list-group-item"><a href="">Quizz 1 : Lorem ipsum quizz</a></li>
                <li class="list-group-item"><a href="">Quizz 2 : Lorem ipsum quizz</a></li>
                <li class="list-group-item"><a href="">Quizz 3 : Lorem ipsum quizz</a></li>
                <li class="list-group-item"><a href="">Quizz 4 : Lorem ipsum quizz</a></li>
                <li class="list-group-item"><a href="">Quizz 5 : Lorem ipsum quizz</a></li>
            </ul>      
        </div>
        <div class="p-3 mb-2 bg-dark text-white">
            <select class="form-control">
                <option>Catégorie 1</option> 
                <option>Catégorie 2</option> 
                <option>Catégorie 3</option> 
            </select>
        </div>
        <div class="alert alert-light" role="alert" id="affichageCategorie">
            
        </div>  
    </div>

       
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="./JS/bootstrap.min.js"></script>
  </body>
  
  <?php include('./include/footer.php');?>


</html>