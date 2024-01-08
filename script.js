const tableBody = document.querySelector("#lastestRegister");

let getUserData = async() => {
    let res = await fetch("http://localhost/api/restaurantSystems/user/user_read.php");
    let value = await res.text();

    let data = JSON.parse(value);
    
    tableBody.innerHTML = ""

    data.forEach(e => {
        tableBody.innerHTML += `
        <tr>
            <td>${e.acc_id}</td>
            <td>${e.acc_name}</td>
            <td>${e.acc_lname}</td>
            <td>${e.acc_phone}</td>
            <td>${e.acc_address}</td>
        </tr>
        `
    });

}

window.onload = getUserData();
