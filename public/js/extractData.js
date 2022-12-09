const convertButton = document.getElementById("convert-button");

convertButton.addEventListener('click', () => {
    const data = extractData(extractionData);
    console.log(data);
    passToPHPServer(data);


})

const extractionData = [
                'wo_number',    // tracking number
                'po_number',
                'scheduled_date',
                'location_customer', // customer
                'trade',
                'nte',
                'location_name', // store ID
    
                // street, zip code, state separately
                'location_address', 
                'location_phone'
                ];

// collects data from the table
const extractData = (extractionData) => {
    console.log(window.location.pathname);
    let data = {};
    extractionData.forEach (item  => {
        currentCell = document.getElementById(item);
        if (currentCell != null) {
            data[item] = currentCell.innerText
        } else {
            data[item] = "N/A";
        }  
    }
    )
    return data;
}

// passes data to the server where it's processed.
const passToPHPServer = (data) => {
    let response = fetch(
        "convertAjax.php", {
            method: "POST",
            headers: {
                'content-type': 'application/json'
            },
            body: JSON.stringify( {
                data: data
            })
        }).then(( response) => {
                console.log(response);
                if (response.status === 200) {
                    console.log('status 200');
                }
            }
            
        )
        }
    
