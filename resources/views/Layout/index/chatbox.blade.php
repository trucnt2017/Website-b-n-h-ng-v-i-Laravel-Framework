<div id="fb-root"></div>
  <style>.cfacebook{
  position:fixed;
  bottom:0px;
  right:8px;
  z-index:999999999999999;
  width:285px;
  height:auto;
  box-shadow:6px 6px 6px 10px rgba(0,0,0,0.2);
  border-top-left-radius:5px;
  border-top-right-radius:5px;
  overflow:hidden;}
  .cfacebook .fchat{
    float:left;
    width:100%;
    height:270px;
    overflow:hidden;
    display:none;
    background-color:#fff;}
    .cfacebook a.chat_fb{
      float:left;
      padding:0 25px;
      width:285px;
      color:#fff;
      text-decoration:none;
      height:40px;
      line-height:40px;
      text-shadow:0 1px 0 rgba(0,0,0,0.1);
      background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAqCAMAAABFoMFOAAAAWlBMV…8/UxBxQDQuFwlpqgBZBq6+P+unVY1GnDgwqbD2zGz5e1lBdwvGGPE6OgAAAABJRU5ErkJggg==);
      background-repeat:repeat-x;
      background-size:auto;
      background-position:0 0;
      background-color:#3a5795;
      border:0;
      border-bottom:1px solid #133783;
      z-index:9999999;
      margin-right:12px;
      font-size:18px;}
      .cfacebook a.chat_fb:hover{
        color:yellow;
        text-decoration:none;}
        </style>
        <style type="text/css">
.chatbox {
  
  height: 600px;
  background: #fff;

 
  box-shadow: 0 3px #ccc;
}
.btn-input {
    height: 27px;
    padding: 5px 10px 5px 0px;
    font-size: 13px;
    line-height: 1.5;
    margin: 0px 0px 0px 5px;
    width: 70%;
  }
.chatlogs {
  padding: 10px;  
  width: 100%;
  height: 230px;
  overflow-x: hidden;
  overflow-y: scroll;
}

.chatlogs::-webkit-scrollbar {
  width: 10px;
}

.chatlogs::-webkit-scrollbar-thumb {
  border-radius: 5px;
  background: rgba(0,0,0,.1);
}

.chat {
  display: flex;
  flex-flow: row wrap;
  align-items: flex-start;
  margin-bottom: 10px;
}


.chat .user-photo {
  width: 60px;
  height: 60px;
  background: #ccc;
  border-radius: 50%;
}

.chat .chat-message {
  width: 65%;
  padding: 15px;
  margin: 5px 10px 0;
  border-radius: 10px;
  color: #fff;
  font-size: 13px;
}

.friend .chat-message {
  background: #1adda4;
}

.self .chat-message {
  background: #1ddced;
  order: -1;
}

.chat-form {
  margin-top: 10px;
  display: flex;
  align-items: flex-start;
}

.chat-form textarea {
  background: #fbfbfb;
  width: 40%;
  height: 26px;
  border: 2px solid #eee;
  border-radius: 3px;
  resize: none;

  font-size: 13px;
  color: #333;
  margin: 0 0 5px 5px;
}

.chat-form textarea:focus {
  background: #fff;
}

.chat-form button {
  background: #1ddced;
  padding: 5px 15px;
  font-size: 10px;
  color: #fff;
  border: none;
  margin: 0 10px;
  border-radius: 3px;
  box-shadow: 0 3px 0 #0eb2c1;
  cursor: pointer;

  -webkit-transaction: background .2s ease;
  -moz-transaction: backgroud .2s ease;
  -o-transaction: backgroud .2s ease;
}

.chat-form button:hover {
  background: #13c8d9;
}</style>
  <style>
            @media only screen and (max-width : 540px) 
            {
                .chat-sidebar
                {
                    display: none !important;
                }
                
                .chat-popup
                {
                    display: none !important;
                }
            }
            
            body
            {
              overflow-x: hidden;
         
            }
            
            .chat-sidebar
            {
                width: 200px;
                position: fixed;
                height: 100%;
                right: 0px;
                top: 51px;
                padding-top: 10px;
                padding-bottom: 10px;
                border: 1px solid rgba(29, 49, 91, .3);
                background:white;
                z-index: 999;
            }
            
            .sidebar-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .sidebar-name span
            {
                padding-left: 5px;
            }
            
            .sidebar-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            .sidebar-name:hover
            {
                background-color:#e1e2e5;
            }
            
            .sidebar-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }
            
            .popup-box
            {
                display: none;
                position: fixed;
                bottom: 0px;
                right: 220px;
                height: 300px;
                background-color: rgb(237, 239, 244);
                width: 300px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .popup-box .popup-head
            {
                background-color: #6d84b4;
                padding: 5px;
                color: white;
                font-weight: bold;
                font-size: 14px;
                clear: both;
            }
            
            .popup-box .popup-head .popup-head-left
            {
                float: left;
            }
            
            .popup-box .popup-head .popup-head-right
            {
                float: right;
                opacity: 0.5;
            }
            
            .popup-box .popup-head .popup-head-right a
            {
                text-decoration: none;
                color: inherit;
            }
            
          
            


        </style>
      <?php $date = date('Y-m-d H:i:s');
      $test=[];
     $array =DB::table('users')->select('id')->get();
     foreach($array as $element)
     {
       $test[] = (string)$element->id;  
     }
     
    if(Auth::check()){
      $flag=1;
      $name=Auth::user()->id;
    }
    else{
      $flag=0;
      $name=0;
    }
      ?>
         <script>
     
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name,table)
            {
                var array=table;
               
              
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
                var element = '<div class="popup-box chat-popup" style="z-index: 999;" id="'+ id +'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left">'+ name +'</div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="popup-messages">';
                element = element + '<div class="chatbox">';
                element = element + '<div class="chatlogs" id="chatform_1_'+id+'">';
                array.forEach(array => {
                    if(array.idMe==id || array.idSent==id)
                    {
                        if(array.idMe==id)
                        {
               
                            element = element + '<div class="chat friend">';
                            element = element + '<div class="user-photo"></div>';
                            element = element + '<p class="chat-message">'+array.content+'</p>'; 
                            element = element + '</div>';
                        }
                        if(array.idSent==id)
                        {
                            element = element + '<div class="chat self">';
                          
                            element = element + '<div class="user-photo"></div>';
                            element = element + '<p class="chat-message">'+array.content+'</p>'; 
                            element = element + '</div>';
                        }
                    }
                });
                element = element + '</div>';
                element = element + '<form  id="chatbox'+id+'">';
                element = element + '<div class="chat-form">';
                element = element + '<input type="hidden" name="_token" value="{{csrf_token()}}">';
                element = element + '<input type="hidden" name="id'+id+'" value="'+id+'">';
                element = element + '<input type="text" class="btn-input" placeholder="Type your message here..." name="content'+id+'" />';
                element = element + '<button>Send</button>';
                element = element + '</form>';
                element = element + '</div>';
                element = element + '</div>';  
                element = element + '</div>';
                element = element +'</div></div>';

              
                // document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
                $('body').append(element);
                popups.unshift(id);
                Init(); 
                calculate_popups();

            }
          
               function open()
               {
                var jsArray = <?php echo json_encode($test); ?>;
                jsArray.forEach(element => {
                    // $('#name'+element).attr('href');
                    // document.getElementById('name'+element).click();
             
                    // window.location.href = $('#name'+element).attr('href');

                    // document.getElementById('<%# name %>'+element).click();
                     
                   
                });
              
               }
            function Init(){
              var jsArray = <?php echo json_encode($test); ?>;
                jsArray.forEach(element => {
              $(document).ready(function(){
                $(`#chat_fb${element}`).on('click',(e) =>{
                $(`#fchat${element}`).toggle('slow');
              });
		          });
              $(`#chatbox${element}`).on('submit', (e) => {
              
                 if ({{$flag}}==0) {
                  alert('Please Login');
                }     
                if ({{$flag}}==1)
                {
                socket.emit('message', {
                    from: "{{$name}}",
                    content: $(`[name=content${element}]`).val(),
                    id: $(`[name=id${element}]`).val(),
                    time: "{{$date}}"
                }, () => {
                   
                    e.preventDefault(); 
                });
							  $.ajax({
        				    type: 'post',
        				    url: 'message',
        				    cache: false,
        				    dataType: 'json',
                            data: { _token:'{!! csrf_token() !!}',
									  content:$(`[name=content${element}]`).val(),
									  id:$(`[name=id${element}]`).val() },
        				    success: function(data) {

                            },
        				  	error: function (request, status, error) {
        					      alert(error);
    						      }
        					});

                  e.preventDefault();
               }
           
 
            });
            });
                }
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups();
                
            }
            
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            
        </script>

<script>
  jQuery(document).ready(function () {
              jQuery('#chat_fb0').click(function() {
              jQuery('#fchat0').toggle('slow');
              });

              jQuery('#sidebar').click(function() {
              jQuery('.chat-sidebar').toggle('slow');
              });
              });
  
        
</script>

  @if(Auth::check())  
          @if(Auth::user()->level!=1)<!--user classic-->
              <div class="cfacebook">
              <a href="javascript:;" class="chat_fb" id="chat_fb1" onclick="return:true;"><i class="fa fa-facebook-square"></i> Hỗ trợ trực tuyến</a>
              <div class="fchat" id="fchat1">
              <div class="chatbox">
              <div class="chatlogs" id="chatform_{{Auth::user()->id}}_1">
                @foreach($message as $ms)
                  @if($ms->idMe==Auth::user()->id || $ms->idSent==Auth::user()->id)
                      @if($ms->idSent==Auth::user()->id)
                      <div class="chat friend">
                      @endif
                      @if($ms->idMe==Auth::user()->id)
                      <div class="chat self">
                      @endif
                    <div class="user-photo"></div>
                    <p class="chat-message">{{$ms->content}}</p> 
                    </div>
                   @endif
                @endforeach
                </div>
                       <form  id="chatbox1">
                           <div class="chat-form">
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                           <input type="hidden" name="id1" value="1">
                           <input class="btn-input" type="text" placeholder="Type your message here..." name="content1" />
                           <button>Send</button>
                       </form>
               </div>
               
              </div>    
                  </div>
          @else <!--admin-->
       
          <div class="chat-sidebar">
            <div id="sidebartol">
            @foreach($user as $us)
            @if($us->id!=Auth::user()->id)
            <div class="sidebar-name" >
                <!-- Pass username and display name to register popup -->
                <a id="name{{$us->id}}" href="javascript:register_popup('{{$us->id}}', '{{$us->name}}',{{$message}});">
                    <img width="30" height="30" src="img/tintuc/{{$us->Hinh}}" />
                    <span>{{$us->name}}</span>
                </a>
            </div>
            @endif
             @endforeach
            </div>
        </div>

          @endif
       
    
  
        
        
  

      







  @else<!--no user-->
  <div class="cfacebook">
  <a href="javascript:;" class="chat_fb" id="chat_fb0" onclick="return:false;"><i class="fa fa-facebook-square"></i> Hỗ trợ trực tuyến</a>
  <div class="fchat" id="fchat0">
    <div class="chatbox">
    <div class="chatlogs">
      <p>Welcome to website </p>
            <p>      Please login to message</p>

    </div>
          <form  id="chatbox" >
                <div class="chat-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="" value="{{csrf_token()}}">
                <input class="btn-input" type="text" placeholder="Type your message here..." name="content" />
                <button>Send</button>
            </form>
    </div>
  </div>   
  </div>
  @endif



    
   	<meta name="csrf-token" content="{{ csrf_token() }}">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>
      <script>
      		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            var socket=io('http://localhost:6001');
              socket.on('message',function(data)  {
                var idSent=data.from;
                var idRecive=data.idRecive;
             
                 
          
                $(`#chatform_${idRecive}_${idSent}`).append('<div class="chat friend"><div class="user-photo"></div><p class="chat-message">'+data.content+'</p> </div>');
                $(`#chatform_${idSent}_${idRecive}`).append('<div class="chat self"><div class="user-photo"></div><p class="chat-message">'+data.content+'</p> </div>');
            
              })
          
              var jsArray = <?php echo json_encode($test); ?>;
                jsArray.forEach(element => {
           
              $(document).ready(function(){
                $(`#chat_fb${element}`).on('click',(e) =>{
                $(`#fchat${element}`).toggle('slow');
              });
		          });
              $(`#chatbox${element}`).on('submit', (e) => {
              
                 if ({{$flag}}==0) {
                  alert('Please Login');
                }     
                if ({{$flag}}==1)
                {
                socket.emit('message', {
                    from: "{{$name}}",
                    content: $(`[name=content${element}]`).val(),
                    id: $(`[name=id${element}]`).val(),
                    time: "{{$date}}"
                }, () => {
                   
                    e.preventDefault(); 
                });
							  $.ajax({
        				    type: 'post',
        				    url: 'message',
        				    cache: false,
        				    dataType: 'json',
                            data: { _token:'{!! csrf_token() !!}',
									  content:$(`[name=content${element}]`).val(),
									  id:$(`[name=id${element}]`).val() },
        				    success: function(data) {

                            },
        				  	error: function (request, status, error) {
        					      alert(error);
    						      }
        					});

                  e.preventDefault();
               }
           
 
            });
            });
            $('#chatbox').on('submit', (e) => {
                  alert('Please Login');
                    e.preventDefault(); 
            });
            </script> 
            
        
  </div>
  </div>
  </div>

