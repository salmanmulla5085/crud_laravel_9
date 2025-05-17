
// showing error message 
function showMessage(type, message) {
    const box = $("#messageBox");
    box.removeClass("d-none alert-success alert-danger").addClass(
        `alert alert-${type}`
    );
    box.text(message);

    setTimeout(() => {
        box.addClass("d-none").text("");
    }, 7000);
}

//ajax functionality

$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    let table = $("#usersTable").DataTable({
        ajax: "/users/list",
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "email" },
            { data: "phone" },
            { data: "address" },
            {
            data: "is_active",
            render: function (data, type, row) {
                if (data == 1) {
                    return '<button class="btn btn-sm btn-success">Active</button>';
                } else {
                    return '<button class="btn btn-sm btn-secondary">Inactive</button>';
                }
            },
        },
            {
                data: null,
                render: function (row) {
                    return `
                        <button class="btn btn-sm btn-info editBtn" data-id="${row.id}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.id}">Delete</button>
                    `;
                },
            },
            
        ],pagingType: "simple_numbers", // options: full_numbers, simple, simple_numbers, numbers
    language: {
        paginate: {
            first: 'First',
            last: 'Last',
            next: '›',
            previous: '‹'
        }
    }
    });

    $("#addUserBtn").on("click", function () {
        $("#userForm")[0].reset();
        $("#user_id").val("");
        $(".password-field").show();
        $("#userModal").modal("show");
    });

    $("#usersTable").on("click", ".editBtn", function () {
        const id = $(this).data("id");
        $.get(`/users/${id}`, function (res) {
            for (let key in res) {
                $(`[name="${key}"]`).val(res[key]);
            }
            $("#user_id").val(id);
            $(".password-field").hide();
            $("#userModal").modal("show");
        });
    });

    $("#usersTable").on("click", ".deleteBtn", function () {
        if (confirm("Delete this user?")) {
            $.ajax({
                url: `/users/${$(this).data("id")}`,
                type: "DELETE",

                data: { _token: $('meta[name="csrf-token"]').attr("content") },
                success: (res) => {
                    table.ajax.reload();
                    showMessage(
                        "success",
                        res.message || "User deleted successfully."
                    );
                },
            });
        }
    });

    $("#userForm").on("submit", function (e) {
        e.preventDefault();
        const id = $("#user_id").val();
        const formData = $(this).serialize();
        const url = id ? `/users/${id}` : `/users`;
        const method = id ? "PUT" : "POST";

        $.ajax({
            url,
            method,
            data: formData,
            success: (res) => {
                $("#userModal").modal("hide");
                table.ajax.reload();
                showMessage(
                    "success",
                    res.message || "User saved successfully."
                );
            },
            error: (xhr) => {
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    let messages = Object.values(errors).flat().join("<br>");
                    showMessage("danger", messages);
                } else {
                    showMessage(
                        "danger",
                        xhr.responseJSON?.message || "An error occurred."
                    );
                }
            },
        });
    });
});
