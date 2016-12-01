<?php
class Quote extends CI_Controller{
    function index(){
        $quotes = array(
            'Hành trình vạn dặm bắt đầu bằng một bước chân',
            'Kẻ thù lớn nhất của đời người là chính mình',
            'Vạn sự khởi đầu nan',
            'Muốn giỏi phải học',
            'Đường xa tới đâu, đi hoài sẽ đến'
        );
        
        $quote = $quotes[rand(0, count($quotes) -1)];
        echo "<i class='text-muted quote'>".$quote."</i>";
    }
}