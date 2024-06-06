function headerSection() {
    return {
        isOpenModal: false,
        isMenuOpen: false,
        showLoginForm: true,
        showRegisterForm: false,

        toggleMenu: function(){
            this.isMenuOpen = !this.isMenuOpen;
        },
        
        openModal:function (){
            this.isOpenModal = true
            this.showLogin()
        },
        
        showLogin: function(){
            this.showLoginForm = true
            this.showRegisterForm = false
        },

        showRegister: function(){
            this.showLoginForm = false
            this.showRegisterForm = true
        }
    }
}