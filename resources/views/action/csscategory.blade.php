<style>
    /* Success Message Styling */
    .success-message {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        position: fixed;
        top: 20px;
        right: 20px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        z-index: 1000;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease-in-out;
    }

    .success-message.show {
        opacity: 1;
        transform: translateX(0);
    }

    .success-message .close-btn {
        color: white;
        font-size: 20px;
        background: transparent;
        border: none;
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
    }

    .success-message .close-btn:hover {
        color: #ffffff;
    }

    /* Success Message Styling */
    .error-message {
        background-color: #ff0026;
        color: white;
        padding: 15px;
        border-radius: 5px;
        position: fixed;
        top: 20px;
        right: 20px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        z-index: 1000;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease-in-out;
    }

    .error-message.show {
        opacity: 1;
        transform: translateX(0);
    }

    .error-message .close-btn {
        color: white;
        font-size: 20px;
        background: transparent;
        border: none;
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
    }

    .error-message .close-btn:hover {
        color: #ffffff;
    }

    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 400px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 25px;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal input, .modal button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .modal button {
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }

    .modal button:hover {
        background-color: #0056b3;
    }

    /* Image Wrapper Styling */
    .image-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
    }


    .modal {
        display: none; 
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4); 
    }

    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
    }

    .close-btn {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .button-container {
        margin-top: 20px;
        display: flex;
        justify-content: space-around;
    }

    .button-container button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    .button-container button:hover {
        background-color: #ddd;
    }

    /* Pagination Styling */
    .pagination {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .pagination-btn:hover {
            background-color: #0056b3;
        }

        .pagination-btn.active {
            background-color: #0056b3;
        }

        .pagination-btn.disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }
</style>