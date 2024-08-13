<template>
    <div class="form-container">
      <form @submit.prevent="handleSubmit">
        <div>
          <label for="full_name">Full Name:</label>
          <input v-model="formData.full_name" id="full_name" type="text" />
        </div>

        <div>
          <label for="email">Email:</label>
          <input v-model="formData.email" id="email" type="email" />
        </div>

        <div>
          <label for="website">Website:</label>
          <input v-model="formData.website" id="website" type="url" />
        </div>

        <div>
          <label for="messages">Messages:</label>
          <textarea v-model="formData.messages" id="messages"></textarea>
        </div>

        <!-- <div>
          <label for="user_ip">User IP:</label>
          <input v-model="formData.user_ip" id="user_ip" type="text" readonly />
        </div> -->

        <div>
          <label for="phone_number">Phone Number:</label>
          <input v-model="formData.phone_number" id="phone_number" type="tel" />
        </div>

        <div>
          <label for="communication_channel">Communication Channel:</label>
          <select v-model="formData.communication_channel" id="communication_channel">
            <option value="1">Email</option>
            <option value="2">Phone</option>
            <option value="3">Chat</option>
          </select>
        </div>

        <div>
          <label for="communication_channel_name">Communication Channel Name:</label>
          <input v-model="formData.communication_channel_name" id="communication_channel_name" type="text" />
        </div>

        <div>
          <label for="communication_channel_number">Communication Channel Number:</label>
          <input v-model="formData.communication_channel_number" id="communication_channel_number" type="text" />
        </div>

        <div>
          <label for="files">Files:</label>
          <input id="files" type="file" multiple @change="handleFileChange" />
        </div>

        <button type="submit">Submit</button>
      </form>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        formData: {
          full_name: 'anhtuan_test',
          email: 'anhtuan@yomail.com',
          website: '',
          messages: '',
          user_ip: '94.0.4606.61',
          phone_number: '+84902584451',
          communication_channel: 7,
          communication_channel_name: 'Other123123123',
          communication_channel_number: '+84902584451',
          files: [],
        }
      };
    },
    methods: {
      handleFileChange(event) {
        // Lấy các tệp tin từ input
        this.formData.files = Array.from(event.target.files);
      },
      async handleSubmit() {
        const formData = new FormData();

        // Thêm tất cả các trường vào FormData
        for (const key in this.formData) {
          if (Array.isArray(this.formData[key])) {
            this.formData[key].forEach((file, index) => formData.append(`files[${index}]`, file));
          } else {
            formData.append(key, this.formData[key]);
          }
        }

        console.log(formData);
        // Gửi yêu cầu với axios
        try {
          const response = await axios.post('https://apitest.paycec.com/api/v1/lead-form/create', formData, {
            headers: {
              'api-public-key': 'EZQzex5tApVxTW0X7s9twkdJoxOBp+THs8RUs5Mwd9k=',
              'location-code': 'gx',
              'language-code': 'en'
            }
          });

          // Xử lý phản hồi
          console.log('Response:', response.data);
        } catch (error) {
          // Xử lý lỗi
          console.error('Error:', error.response ? error.response.data : error.message);
        }
      }
    }
  };
  </script>

  <style scoped>
  .form-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  form {
    display: flex;
    flex-direction: column;
  }

  form div {
    margin-bottom: 1.5rem;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #333;
  }

  input,
  textarea,
  select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 1rem;
    color: #333;
  }

  textarea {
    resize: vertical;
    min-height: 150px;
  }

  input[type="file"] {
    border: none;
    padding: 0;
  }

  button {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }

  button:hover {
    background-color: #0056b3;
  }

  button:disabled {
    background-color: #d6d6d6;
    cursor: not-allowed;
  }

  @media (max-width: 600px) {
    .form-container {
      padding: 1rem;
    }

    input,
    textarea,
    select {
      font-size: 0.875rem;
    }

    button {
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
    }
  }
  </style>
