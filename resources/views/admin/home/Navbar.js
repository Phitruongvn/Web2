import React, { useEffect, useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBars, faUserCog, faSignOutAlt } from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';

const CustomNavbar = ({ toggleSidebar }) => {
    const [user, setUser] = useState(null);
    const [dropdownOpen, setDropdownOpen] = useState(false);

    useEffect(() => {
        // Fetch current user info when component mounts
        const fetchUser = async () => {
            try {
                const response = await axios.get('/admin/current-user');
                if (response.data.isAuthenticated) {
                    setUser(response.data.user);
                }
            } catch (error) {
                console.error('Error fetching user:', error);
            }
        };
        fetchUser();
    }, []);

    const handleLogout = async () => {
        try {
            await axios.post('/admin/logout');
            window.location.href = '/admin/login';
        } catch (error) {
            console.error('Error logging out:', error);
        }
    };

    return (
        <nav className="bg-blue-700 text-white shadow-md">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex items-center justify-between h-16">
                    {/* Logo and Title */}
                    <div className="flex items-center">
                        <button
                            onClick={toggleSidebar}
                            className="text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none"
                        >
                            <FontAwesomeIcon icon={faBars} />
                        </button>
                        <div className="ml-4">
                            <FontAwesomeIcon icon={faUserCog} className="w-6 h-6" />
                            <span className="ml-2 text-xl font-semibold">Quản Lý Admin</span>
                        </div>
                    </div>

                    {/* User Menu */}
                    <div className="flex items-center">
                        {user ? (
                            <div className="relative">
                                <button
                                    onClick={() => setDropdownOpen(!dropdownOpen)}
                                    className="flex items-center space-x-2 text-white hover:text-gray-200 focus:outline-none"
                                >
                                    <span className="text-sm font-medium">
                                        Xin chào, {user.name}
                                    </span>
                                </button>
                                
                                {dropdownOpen && (
                                    <div className="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                        <button
                                            onClick={handleLogout}
                                            className="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >
                                            <FontAwesomeIcon icon={faSignOutAlt} className="mr-2" />
                                            Đăng xuất
                                        </button>
                                    </div>
                                )}
                            </div>
                        ) : (
                            <a href="/admin/login" className="text-white hover:text-gray-200">
                                Đăng nhập
                            </a>
                        )}
                    </div>
                </div>
            </div>
        </nav>
    );
};

export default CustomNavbar;
