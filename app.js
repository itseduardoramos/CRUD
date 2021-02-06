$(document).ready(function() {
    let editar = false;
    console.log('jquery esta funcionando');
    $("#resultado").hide();
    fetchProducto();

    //BUSCA UN PRODUCTO
    $('#search').keyup(function(e) {
        if ($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
            url: 'task-search.php',
            type: 'POST',
            data: { search },
            success: function (response) {
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(producto =>{
                    template += `<li>
                    ${producto.nombre}
                    </li>`
                });
                $('#container').html(template);
                $('#resultado').show();
            }
        });
            
        }
    })

    //AGREGA EL PRODUCTO A LA LISTA
    $('#form-producto').submit(function(e) {
       const postData = {
           name: $('#nombre').val(),
           description: $('#descripcion').val(),
           id: $('#productoId').val()
       };
       let url = editar === false ? 'task-add.php'  : 'task-edit.php';
       console.log(url);
       $.post(url, postData, function(response){
           console.log(response);
           fetchProducto();
           $('#form-producto').trigger('reset');
       })
       e.preventDefault();
    });

    //MUESTRA LA LISTA DE PRODUCTOS
    function fetchProducto() {
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: function(response) {
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(producto =>{
                    template += `
                        <tr productoId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class="producto-item">${producto.nombre}</a>
                        </td>
                        <td>${producto.descripcion}</td>
                        <td>
                            <button class="task-delete btn btn-danger">Borrar</button>
                        </td>
                        </tr>
                    `
                });
                $('#producto').html(template);
            }
        });
    }

    $(document).on('click', '.producto-item', function() {
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('productoId');
        $.post('task-single.php',{id}, function(response) {
            const producto = JSON.parse(response);
            $('#nombre').val(producto.nombre);
            $('#descripcion').val(producto.descripcion);
            $('#productoId').val(producto.id);
            editar = true;
        });
    });
});