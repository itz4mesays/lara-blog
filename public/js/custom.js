const success_toastr = (msg) => {
    Toastify({
        text: msg,
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        backgroundColor: "linear-gradient(to bottom, #00b09b, #28a745)", //#00b09b #96c93d
        stopOnFocus: true, // Prevents dismissing of toast on hover
        onClick: function () { }, // Callback after click
        }).showToast();
    }

const error_toastr = (msg) => {
    Toastify({
      text: msg,
      duration: 5000,
      newWindow: true,
      close: false,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      backgroundColor: "linear-gradient(to right, rgba(255,0,0,1), rgba(255,0,0,1))",
      stopOnFocus: true, // Prevents dismissing of toast on hover
      onClick: function () { }, // Callback after click
    }).showToast();
}

const loadingImage = (loadingClass) => {
    var img=$('<img id="loading">');     
    $(document.createElement('img'));
    img.attr('src',baseURL + "/storage/spinners/loading.gif");
    img.attr('height', 40)
    img.appendTo(loadingClass);
}

const baseURL = window.location.origin

$('.duid').on('click', function(e){
    e.preventDefault()

    let currentCount, x , uid, splitUid
    x = $(this).find('span') //get current number of likes
    uid = $(this).data('uid')
    splitUid = uid.split('_')

    currentCount = parseInt(x.html())
    currentCount++

    let data = {
        'post_id' : parseInt(splitUid[1]),
        'type': splitUid[0],
        'countNum': currentCount
    }

    fetch(baseURL +'/user/posts/likes', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    }).then(response => response.json())
    .then(response => {
        let responseCode = response.status
        if(responseCode === 400){
            const res = Object.values(response.data)
            let x = ''
            for (let i = 0; i < res.length; i++) {
                x += '* ' + res[i][0] + ' \n'
            }
            error_toastr(x)
        }else if(responseCode === 500 || responseCode === 422){
            error_toastr(response.data)
        }else{
            x.html(Math.abs(currentCount))
            success_toastr(response.data)
        }
    }).catch(err => {
        error_toastr(err)
    })

})


$('.comment').on('click', function (e){
    e.preventDefault()
    $("html, body").animate({ scrollTop: $(document).height() }, 1000)
    $('.commentSection').animate({opacity: "show"}, 500)

    let currentSelection = $(this)
})


$('.addReply').on('click', function(){
    let currentSelection = $(this)
    $('.replyForm').animate({opacity: "show"}, 600)

    var replyForm = `<form action="" method="POST" class="subComment">
        <div class="form-group">
            <textarea class="form-control" rows="1" placeholder="Enter your reply here..."></textarea>
            <div class="divider"></div>
            <input class="btn btn-primary btn-sm submitReply" id="submitReply" type="submit" value="Send Reply">
        </div>
    </form>`
    $(this).closest('.media-block').find('.replyForm').html(replyForm)

})

//Add Main Comment to a post
$('#add-comment').on('submit', function(e){
    e.preventDefault()

    let commCount = $('.commentCount').find('span').html()
    let msgBody = $('#id_message').val()
    let pid = $('.postColl').data('post')
    let url = baseURL + '/user/posts/add-comment'
    let loadingClassDiv = $('.loading')
    if(msgBody != null && pid != null){ //either variable is not null or undefined

        loadingImage(loadingClassDiv)

        fetch(url, {
            method: 'POST',
            body: JSON.stringify({message: msgBody, pid}),
            headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).then(result => result.json())
        .then(result => {

            if(result.code === 201){
                $('#add-comment').trigger('reset')
                $("html, body").animate({ scrollTop: $(document).height() }, 1000)
                let reply = commentMessage(result)

                if(!$('.media-block').is(':visible')){
                    $('.commentSection').after(reply)
                }else{
                    $('.media-block').last().append(reply)
                }
                            
                commCount++ //increment the count on the view without refreshing
                $('.commentCount').find('span').html(commCount)

                success_toastr(result.msg)
            }else{
                error_toastr(result.message)
            }

            $('.loading').empty()
             
        }).catch(err => console.log(err))
    }

    const commentMessage = (result) => {
         return replyMessage = `<div class="media-block"><a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
         <div class="media-body">
             
             <div class="mar-btm">
                 <a href="#" class="btn-link text-semibold media-heading box-inline">${result.username}</a>
                 <p class="text-muted text-sm"><i class="fa fa-clock fa-lg"></i> - Date Posted - ${result.date_created}</p>
             </div>
             
             <p>${result.message}</p>
             
             <div class="pad-ver">
                 <div class="btn-group">
                     <p class="btn btn-sm btn-default btn-hover-success replyBtn" data-comment="${result.id}"><i class="fa fa-thumbs-up"></i></p>
                     <p class="btn btn-sm btn-default btn-hover-danger replyBtn" data-comment="${result.id}"><i class="fa fa-thumbs-down"></i></p>
                     <p class="addReply" href="#">Reply</p>
                 </div>
             </div>

             <div class="replyForm"></div>

         </div></div>`
    }
})