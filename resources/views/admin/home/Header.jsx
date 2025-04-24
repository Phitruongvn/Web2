import React, { useState } from 'react';

const Header = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [dropdownOpen, setDropdownOpen] = useState({
    product: false,
    post: false,
    interface: false,
  });

  const toggleDropdown = (menu) => {
    setDropdownOpen((prev) => ({
      ...prev,
      [menu]: !prev[menu],
    }));
  };

  return (
    <nav className="bg-blue-700 text-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center">
            <a href="/admin" className="text-xl font-bold hover:text-blue-200">
              Quản lý hệ thống
            </a>
          </div>
          <div className="hidden lg:flex items-center space-x-6">
            {/* Product Dropdown */}
            <div className="relative">
              <button
                onClick={() => toggleDropdown('product')}
                className="hover:text-blue-200"
              >
                Sản phẩm
              </button>
              {dropdownOpen.product && (
                <div className="absolute mt-2 w-48 bg-blue-800 text-white shadow-md rounded-md">
                  <a
                    href="/admin/product"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Danh sách sản phẩm
                  </a>
                  <a
                    href="/admin/category"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Danh mục
                  </a>
                  <a
                    href="/admin/brand"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Thương hiệu
                  </a>
                </div>
              )}
            </div>

            {/* Post Dropdown */}
            <div className="relative">
              <button
                onClick={() => toggleDropdown('post')}
                className="hover:text-blue-200"
              >
                Bài viết
              </button>
              {dropdownOpen.post && (
                <div className="absolute mt-2 w-48 bg-blue-800 text-white shadow-md rounded-md">
                  <a
                    href="/admin/post"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Danh sách bài viết
                  </a>
                  <a
                    href="/admin/topic"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Chủ đề
                  </a>
                </div>
              )}
            </div>

            {/* Interface Dropdown */}
            <div className="relative">
              <button
                onClick={() => toggleDropdown('interface')}
                className="hover:text-blue-200"
              >
                Giao diện
              </button>
              {dropdownOpen.interface && (
                <div className="absolute mt-2 w-48 bg-blue-800 text-white shadow-md rounded-md">
                  <a
                    href="/admin/menu"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Menu
                  </a>
                  <a
                    href="/admin/banner"
                    className="block px-4 py-2 hover:bg-blue-600"
                  >
                    Banner
                  </a>
                </div>
              )}
            </div>

            {/* Static Links */}
            <a href="/admin/contact" className="hover:text-blue-200">
              Liên hệ
            </a>
            <a href="/admin/order" className="hover:text-blue-200">
              Đơn hàng
            </a>
            <a href="/admin/user" className="hover:text-blue-200">
              Thành viên
            </a>
          </div>

          {/* Mobile Menu */}
          <div className="lg:hidden">
            <button
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              className="hover:text-blue-200"
            >
              <svg
                className="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M4 6h16M4 12h16m-7 6h7"
                ></path>
              </svg>
            </button>
          </div>
        </div>

        {/* Mobile Dropdown Menu */}
        {isMenuOpen && (
          <div className="lg:hidden mt-2 bg-blue-800 text-white rounded-md shadow-md">
            <a href="/admin/contact" className="block px-4 py-2 hover:bg-blue-600">
              Liên hệ
            </a>
            <a href="/admin/order" className="block px-4 py-2 hover:bg-blue-600">
              Đơn hàng
            </a>
            <a href="/admin/user" className="block px-4 py-2 hover:bg-blue-600">
              Thành viên
            </a>
          </div>
        )}
      </div>
    </nav>
  );
};

export default Header;
