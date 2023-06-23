require('./bootstrap');
import 'filepond/dist/filepond.min.css';
import '../css/filepond.css'; // Adjust the path based on your project structure


import FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
window.FilePond = FilePond;
FilePond.registerPlugin(FilePondPluginFileValidateType);
