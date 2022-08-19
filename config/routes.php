<?php

return Array(
  '#^/admin/product/delete_product.{0,1}$#!' => 'AdminController.delete_product',
  '#^/admin/product/create_product.{0,1}$#!' => 'AdminController.create_product',
  '#^/admin/product/delete_image.{0,1}$#!' => 'AdminController.delete_image',
  '#^/admin/product/create_image.{0,1}$#!' => 'AdminController.create_image',
  '#^/admin/product/change.{0,1}$#!' => 'AdminController.product_change',
  '#^/admin/get_product_info.{0,1}$#!' => 'AdminController.get_product_info',
  '#^/admin/users.{0,1}$#!' => 'AdminController.users',
  '#^/admin/orders.{0,1}$#!' => 'AdminController.orders',
  '#^/admin/products.{0,1}$#!' => 'AdminController.products',
  '#^/admin/auth.{0,1}$#' => 'AdminController.auth',
  '#^/admin/login.{0,1}$#' => 'AdminController.login',
  '#^/admin.{0,1}$#' => 'AdminController.login_redirect',
  '#^/admin.{0,1}$#!' => 'AdminController.index',
  '#.*#' => 'NotFoundController.index',
  '#.*#!' => 'NotFoundController.index',
);