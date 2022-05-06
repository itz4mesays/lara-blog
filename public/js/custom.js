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

$('.duid').on('click', function(e){
    e.preventDefault()

    let currentCount, x , uid, splitUid
    x = $(this).find('span') //get current number of likes
    uid = $(this).data('uid')
    splitUid = uid.split('_')

    // let btnType = $('.duid').data('uid')
    currentCount = parseInt(x.html())
    currentCount++
    
    let data = {
        'post_id' : parseInt(splitUid[1]),
        'type': splitUid[0],
        'countNum': currentCount
    }

    const baseURL = window.location.origin

    fetch(baseURL +'/user/posts/likes', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    }).then(response => response.json())
    .then(response => {
        let responseCode = response.status
        if(responseCode == 400){
            const res = Object.values(response.data)
            let x = ''
            for (let i = 0; i < res.length; i++) {
            x += '* ' + res[i][0] + ' \n'
            }
            error_toastr(x)
        }else if(responseCode == 500 || responseCode == 422){
            error_toastr(response.data)
        }else{
            x.html(Math.abs(currentCount))
            success_toastr(response.data)
        }
    }).catch(err => {
        error_toastr(err)
    })
      
})




