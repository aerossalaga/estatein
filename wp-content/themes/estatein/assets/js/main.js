/**
 * Estatein Theme Main JavaScript
 * 
 * This file contains all the main interactive functionality of the Estatein theme
 * including mobile navigation, banner management, and accessibility enhancements.
 */
document.addEventListener('DOMContentLoaded', () => {
    console.log('Document loaded and ready!');
    
    // Mobile menu functionality with accessibility improvements
    const mobileToggle = document.querySelector('.header-mobile-toggle');
    const mobileNav = document.querySelector('.header-mobile-nav');
    const mobileClose = document.querySelector('.header-mobile-nav-close');
    const overlay = document.querySelector('.mobile-menu-overlay');
    let focusableElements;
    let firstFocusableElement;
    let lastFocusableElement;
    
    // Get all focusable elements inside mobile nav for keyboard trap
    if (mobileNav) {
        focusableElements = mobileNav.querySelectorAll(
            'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
        );
        firstFocusableElement = focusableElements[0];
        lastFocusableElement = focusableElements[focusableElements.length - 1];
    }
    
    const openMobileMenu = () => {
        if (mobileNav) {
            mobileNav.classList.add('active');
            mobileNav.setAttribute('aria-hidden', 'false');
            mobileToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
            
            if (overlay) {
                overlay.classList.add('active');
                overlay.setAttribute('aria-hidden', 'false');
            }
            
            // Set focus on the first focusable element
            setTimeout(() => {
                mobileClose.focus();
            }, 100);
            
            // Add escape key listener
            document.addEventListener('keydown', handleEscKey);
            
            // Add keyboard trap
            mobileNav.addEventListener('keydown', trapTabKey);
        }
    };
    
    const closeMobileMenu = () => {
        if (mobileNav) {
            mobileNav.classList.remove('active');
            mobileNav.setAttribute('aria-hidden', 'true');
            mobileToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = ''; // Re-enable scrolling
            
            if (overlay) {
                overlay.classList.remove('active');
                overlay.setAttribute('aria-hidden', 'true');
            }
            
            // Return focus to toggle button
            mobileToggle.focus();
            
            // Remove escape key listener
            document.removeEventListener('keydown', handleEscKey);
            
            // Remove keyboard trap
            mobileNav.removeEventListener('keydown', trapTabKey);
        }
    };
    
    // Handle Escape key press
    const handleEscKey = (e) => {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    };
    
    // Trap keyboard focus inside mobile menu
    const trapTabKey = (e) => {
        // Check for TAB key press
        if (e.key === 'Tab') {
            // SHIFT + TAB
            if (e.shiftKey) {
                if (document.activeElement === firstFocusableElement) {
                    e.preventDefault();
                    lastFocusableElement.focus();
                }
            // TAB
            } else {
                if (document.activeElement === lastFocusableElement) {
                    e.preventDefault();
                    firstFocusableElement.focus();
                }
            }
        }
    };
    
    if (mobileToggle) {
        mobileToggle.addEventListener('click', openMobileMenu);
    }
    
    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileMenu);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeMobileMenu);
    }
    
    // Close mobile menu on window resize if screen becomes larger than mobile breakpoint
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // md breakpoint
            closeMobileMenu();
        }
    });
    
    // Banner close functionality with accessibility improvements
    const bannerCloseBtn = document.querySelector('.banner-close');
    if (bannerCloseBtn) {
        bannerCloseBtn.addEventListener('click', () => {
            const banner = document.querySelector('.banner');
            if (banner) {
                banner.style.display = 'none';
                document.body.classList.remove('banner-active');
                
                // Save banner closed state in localStorage
                localStorage.setItem('estatein_banner_closed', 'true');
                
                // Announce to screen readers that banner is closed
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.classList.add('sr-only');
                announcement.textContent = 'Banner closed';
                document.body.appendChild(announcement);
                
                // Remove the announcement after it's been read
                setTimeout(() => {
                    document.body.removeChild(announcement);
                }, 1000);
            }
        });
        
        // Check if banner was previously closed
        if (localStorage.getItem('estatein_banner_closed') === 'true') {
            const banner = document.querySelector('.banner');
            if (banner) {
                banner.style.display = 'none';
                document.body.classList.remove('banner-active');
            }
        }
    }
    
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Set focus to the target element
                targetElement.setAttribute('tabindex', '-1');
                targetElement.focus();
                
                // Update URL without page jump
                history.pushState(null, null, targetId);
            }
        });
    });
    
    // Add screen reader CSS
    if (!document.getElementById('sr-only-css')) {
        const style = document.createElement('style');
        style.id = 'sr-only-css';
        style.textContent = `
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
        `;
        document.head.appendChild(style);
    }
}); 