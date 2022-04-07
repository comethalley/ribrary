const table = document.querySelector(".action");

// function loadFetch() {
//     fetch('table.php')
//         .then(response => response.json())
//         .then(data => {

//             let output = '';
//             let count = 1
//             for (let i in data) {
//                 output += `<tr>
//                 <td> ${count}</td>
//                 <td> ${data[i].User_id}</td>
//                 <td> ${data[i].firstname}</td>
//                 <td> ${data[i].lastname}</td>
//                 <td> ${data[i].Username}</td>
//                 <td>
//                     <p class="user-status"> ${data[i].user_status}</p>
//                 </td>
//                 <td><i class="fa fa-solid fa-pen editbtn"></i>
//                     <i class="fa fa-solid fa-trash deletebtn"></i>
//                 </td>
//             </tr>`
//                 count++
//             }
//             table.innerHTML = output;

//         })
//         .catch(error => console.log(error))
// }



// function checkStatus() {
    const user_status = document.querySelectorAll('.user-status');

    user_status.forEach(element => {

        if (element.innerText == "online") {
            element.classList.add('online')
        } else {
            element.classList.add('offline')
        }

    });
// }

// setInterval(function () {
//     loadFetch();
//     // 1sec
// }, 1000);



// setInterval(function () {
//     checkStatus();
//     // 1sec
// }, 2000);

// window.onload = checkStatus;
// window.onload = loadFetch;
