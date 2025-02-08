import React, { useState, useEffect } from 'react';
import axios from 'axios';

const ProductList = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        // Appel API pour récupérer les produits
        axios.get('/api/products')
            .then(response => {
                setProducts(response.data);
            })
            .catch(error => {
                console.error("Il y a une erreur lors de la récupération des produits:", error);
            });
    }, []);

    return (
        <div>
            <h1>Liste des Produits</h1>
            <ul>
                {products.map(product => (
                    <li key={product.id}>{product.name} - {product.price}€</li>
                ))}
            </ul>
        </div>
    );
};

export default ProductList;
