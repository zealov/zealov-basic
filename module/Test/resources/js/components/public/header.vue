<template>
    <div class="navbar">
        <hamburger
            id="hamburger-container"
            :is-active="sidebar.opened"
            class="hamburger-container"
            @toggleClick="toggleSideBar"
        />

        <div class="right-menu">
            <el-dropdown class="avatar-container right-menu-item hover-effect" trigger="click">
                <div class="avatar-wrapper">
                    <span class="user-name">张三</span>
                    <i class="el-icon-arrow-down"/>
                </div>
                <el-dropdown-menu slot="dropdown">
                    <router-link to="/profile/index">
                        <el-dropdown-item>个人信息</el-dropdown-item>
                    </router-link>
                    <el-dropdown-item divided @click.native="logout">
                        <span style="display:block;">退出登录</span>
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
import Hamburger from '~/components/Hamburger'

export default {
    components: {
        Hamburger
    },
    data() {
        return {
            displayName: ''
        }
    },
    computed: {
        ...mapGetters({
            sidebar: 'app/sidebar',
        })
    },
    created() {

    },
    methods: {
        toggleSideBar() {
            this.$store.dispatch('app/toggleSideBar')
        },
    }
}
</script>

<style lang="scss" scoped>
.navbar {
    height: 50px;
    overflow: hidden;
    position: relative;
    background: #fff;
    box-shadow: 0 1px 4px rgba(0, 21, 41, 0.08);

    .hamburger-container {
        line-height: 46px;
        height: 100%;
        float: left;
        cursor: pointer;
        transition: background 0.3s;
        -webkit-tap-highlight-color: transparent;

        &:hover {
            background: rgba(0, 0, 0, 0.025);
        }
    }

    .breadcrumb-container {
        float: left;
    }

    .errLog-container {
        display: inline-block;
        vertical-align: top;
    }

    .right-menu {
        float: right;
        height: 100%;
        line-height: 50px;

        &:focus {
            outline: none;
        }

        .right-menu-item {
            display: inline-block;
            padding: 0 8px;
            height: 100%;
            font-size: 14px;
            vertical-align: text-bottom;

            &.hover-effect {
                cursor: pointer;
                transition: background 0.3s;

                &:hover {
                    background: rgba(0, 0, 0, 0.025);
                }
            }
        }

        .avatar-container {
            margin-right: 15px;

            &.hasSetting {
                margin-right: 48px;
            }

            .avatar-wrapper {
                position: relative;

                .user-avatar {
                    cursor: pointer;
                    width: 40px;
                    height: 40px;
                    border-radius: 10px;
                }

                .user-name {
                    margin-right: 5px;
                }

                .el-icon-caret-bottom {
                    cursor: pointer;
                    position: absolute;
                    right: -20px;
                    top: 25px;
                    font-size: 12px;
                }
            }
        }

        .el-dropdown {
            color: inherit;
        }
    }
}

.el-popper {
    margin: 0 !important;
}

.el-dropdown-menu {
    margin: 0 !important;
}
</style>
