import './bootstrap';
import Swal from 'sweetalert2';

window.addEventListener('alert', event => {

    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type,
        confirmButtonText: 'Ok'
    }).then(() => {
        if(event.detail.click){
            document.getElementById(event.detail.click).click();
        }
    });

})

window.addEventListener('updateJsonViewer', event => {

    document.querySelector('#json-data-viewer').data = JSON.parse(event.detail.jsonData);
    document.querySelector('#json-body-viewer').data = JSON.parse(event.detail.jsonBody);

});

window.addEventListener('confirmOriginRemove', event => {

    Swal.fire({
        title: 'Confirmação',
        text: 'Deseja remover a origem '+event.detail.title+'?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Não',
        confirmButtonText: 'Confirmar Remoção'
    }).then((res) => {
        if(res.isConfirmed){
            Livewire.emit('scoped__removeOrigin',event.detail.id);
        }
    })

});

window.addEventListener('confirmServiceRemove', event => {

    Swal.fire({
        title: 'Confirmação',
        text: 'Deseja remover o serviço '+event.detail.title+'?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Não',
        confirmButtonText: 'Confirmar Remoção'
    }).then((res) => {
        if(res.isConfirmed){
            Livewire.emit('scoped__removeService',event.detail.id);
        }
    })

})


// Json Viewer




