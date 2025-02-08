import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom';
import ProductList from './components/ProductList.jsx';// Assure-toi que le chemin vers ce fichier est correct.

const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<ProductList />);
